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
                $daoToken = new DAOToken($conn);

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
        if(!isset($_PUT["password"]) || !isset($_PUT["passwordConf"]))
            $resp->setMsg("Todos los campos son obligatorios!");
        else if(empty(trim($_PUT["password"])) || empty(trim($_PUT["passwordConf"])))
            $resp->setMsg("Hay campos vacios por favor verifique!");
        else if($_PUT["password"] != $_PUT["passwordConf"])
            $resp->setMsg("Las contraseñas no coinciden!");
        else if(!isset($_PUT["token"]))
            $resp->setMsg("Token de autenticación no enviado!");
        else if(empty(trim($_PUT["token"])))
            $resp->setMsg("Token de autenticación no enviado!");
        else
        {
            $token = $fv->strictFilterString($_PUT["token"]);
            $password = $fv->filterString($_PUT["password"]);
            $passwordConf = $fv->filterString($_PUT["passwordConf"]);

            //La contraseña debe ir hasheada con el algoritmo md5, de acuerdo a la base de datos
            $password_conf = hash("SHA512", $passwordConf);

            
        }
    }

    $resp->send();

?>