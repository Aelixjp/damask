<?php

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Origin: localhost");
    header("Content-Type: application/json; charset=utf-8");

    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../utils/utils.php";
    require_once __DIR__ . "/../classes/response.php";
    require_once __DIR__  . "/../validations/filterValidator.php";

    $resp = new Response();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!isset($_POST["username"]) || !isset($_POST["password"]))
            $resp->setMsg("No se ha enviado información para el login!");
        else if(empty(trim($_POST["username"])) || empty(trim($_POST["password"])))
            $resp->setMsg("Hay campos vacios porfavor verifique!");
        else
        {
            $fv = new FilterValidator();

            $username = $fv->strictFilterString($_POST["username"]);
            $password = $fv->filterString($_POST["password"]);

            $resAuth = checkAuthenticatedInDb($conn, $username, $password);
            
            if(!$resAuth || empty($resAuth))
                $resp->setMsg("Inicio de sesión invalido!");
            else
            {
                $sessData = $resAuth[0];

                $_SESSION["ID"] = $sessData["ID"];
                $_SESSION["name"] = $sessData["name"];
                $_SESSION["username"] = $sessData["username"];

                $resp->setStatus(true)->setMsg("OK");
            }
        }

        
    }
    else
        $resp->setMsg("Metodo de petición no permitido!");

    $resp->send();

?>