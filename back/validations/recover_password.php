<?php
    ini_set("display_errors", E_ALL);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");

    require_once __DIR__ . "/../classes/response.php";
    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../DAO/DAOUser.php";
    require_once __DIR__ . "/../DAO/DAOToken.php";
    require_once __DIR__ . "/../classes/emailSender.php";

    $resp = new Response();

    if($_SERVER["REQUEST_METHOD"] != "GET")
        $resp->setMsg("Metodo de petición no valido!");
    else if(!isset($_GET["username"]))
        $resp->setMsg("El campo usuario es requerido!");
    else if(empty(trim($_GET["username"])))
        $resp->setMsg("Hay campos vacios porfavor verifique!");
    else
    {
        $user = $_GET["username"];

        $daoUser = new DAOUser($conn);
        $userInfo = $daoUser->getUserByUsername($user);

        if(!$userInfo->getStatus())
            $resp->setMsg("El usuario no existe!");
        else
        {
            $daoToken = new DAOToken($conn);

            $user = $userInfo->getData();
            $name = $user->getName();
            $email = $user->getEmail();
            $username = $user->getUsername();

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

    print_r($resp);

?>