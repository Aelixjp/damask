<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, PUT");
    header("Content-Type: application/json; charset=utf-8");

    require_once __DIR__ . "/../classes/response.php";
    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../validations/filterValidator.php";
    require_once __DIR__ . "/../DAO/DAOUser.php";
    require_once __DIR__ . "/../DAO/DAOToken.php";
    require_once __DIR__ . "/../classes/emailSender.php";

    $fv = new FilterValidator();
    $resp = new Response();
    $daoUser = new DAOUser($conn);
    $daoToken = new DAOToken($conn);

    function checkValidToken(string $token)
    {
        global $conn;
        global $daoToken;

        $tokenDT = $daoToken->getToken($token);

        return $tokenDT;
    }

    if(!($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "PUT"))
        $resp->setMsg("Metodo de petición no valido!");
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!isset($_POST["username"]))
            $resp->setMsg("El campo usuario es requerido!");
        else if(empty(trim($_POST["username"])))
            $resp->setMsg("Hay campos vacios porfavor verifique!");
        else
        {
            $user = $_POST["username"];

            $daoUser = new DAOUser($conn);
            $userInfo = $daoUser->getUserByUsername($user);

            if(!$userInfo->getStatus())
                $resp = $userInfo;
            else
            {
                $user = $userInfo->getData();
                $name = $fv->strictFilterString($user->getName());
                $email = $fv->filterEmail($user->getEmail());
                $username = $fv->strictFilterString($user->getUsername());

                $tokenGenerated = $daoToken->genTokenByEmail($email);

                if(!$tokenGenerated->getStatus())
                    $resp = $tokenGenerated;
                else
                {   
                    $token = $tokenGenerated->getData()["token"];

                    $emailSender = new EmailSender($email, "Recuperación de contraseña");
                    $emailSender->fillAndGetRecoveryPasswordTemplate($username, $token);

                    $resp = $emailSender->send();
                }
            }
        }
    }
    else if($_SERVER["REQUEST_METHOD"] == "PUT")
    {
        parse_str(file_get_contents("php://input"), $_PUT); 

        if(!isset($_PUT["password"]) || !isset($_PUT["passwordConf"]))
            $resp->setMsg("Todos los campos son obligatorios!");
        else if(empty(trim($_PUT["password"])) || empty(trim($_PUT["passwordConf"])))
            $resp->setMsg("Hay campos vacios por favor verifique!");
        else if($_PUT["password"] != $_PUT["passwordConf"])
            $resp->setMsg("Las contraseñas no coinciden!");
        else if(!isset($_PUT["token"]))
            $resp->setMsg("Token de autenticación no enviado!");
        else if(empty(trim($_PUT["token"])))
            $resp->setMsg("Token de autenticación vacio!");
        else
        {
            $token = $fv->strictFilterString($_PUT["token"]);
            $tokenDT = checkValidToken($token);

            if(!$tokenDT->getStatus())
                $resp = $tokenDT;
            else if(empty($tokenDT->getData()))
                $resp = $tokenDT;
            else
            {
                $email = $fv->filterEmail($tokenDT->getData()->getEmail());
                $password = $fv->filterString($_PUT["password"]);
                $passwordConf = $fv->filterString($_PUT["passwordConf"]);

                //La contraseña debe ir hasheada con el algoritmo md5, de acuerdo a la base de datos
                $password_conf = hash("SHA512", $passwordConf);
                $tokensDeleted = $daoToken->deleteTokensByEmail($email);
                $passwordChanged = $daoUser->updatePasswordByEmail($email, $password_conf);

                if(!$passwordChanged->getStatus())
                    $resp->setMsg("Ha ocurrido un error!, no ha sido posible cambiar la contraseña!");
                else
                {
                    $resp->setStatus(true);
                    $resp->setMsg("Contraseña actualizada con exito!");
                }
            }
        }
    }

    $resp->send();

?>