<?php 

    if(session_status() == PHP_SESSION_NONE)
        session_start();

    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__  . "/../DAO/DAOUser.php";
    require_once __DIR__  . "/../models/user.php";
    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";
    require_once __DIR__  . "/../validations/filterValidator.php";

    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=utf-8");

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(
            !isset($_POST["name"]) || !isset($_POST["username"]) || !isset($_POST["email"]) ||
            !isset($_POST["password"]) || !isset($_POST["passwordConf"])
        ){
            $resp->setMsg("Se ha omitido informacion necesaria para crear un usuario!");
        }
        else if(
            empty($_POST["name"]) || empty($_POST["username"]) || empty($_POST["email"]) ||
            empty($_POST["password"]) || empty($_POST["passwordConf"])
        )
            $resp->setMsg("Hay campos vacios, por favor compruebe!");
        else
        {
            $user = new User();
            $DAOUser = new DAOUser($conn);
            $filter = new FilterValidator();

            $name     = $filter->strictFilterString($_POST["name"]);
            $email    = $filter->filterEmail($_POST["email"]);
            $username = $filter->strictFilterString($_POST["username"]);
            $password = $filter->filterString($_POST["password"]);
            $passwordConf = $filter->filterString($_POST["passwordConf"]);

            if($password != $passwordConf)
                $resp->setMsg("Las contraseñas no coinciden!");
            else
            {
                //La contraseña debe ir hasheada con el algoritmo md5, de acuerdo a la base de datos
                $password_conf = hash("SHA512", $passwordConf);
                
                $user->setName($name)
                     ->setEmail($email)
                     ->setUsername($username)
                     ->setPassword($password_conf);

                $resp = $DAOUser->addUser($user);

                if($resp->getStatus())
                {
                    $_SESSION["ID"] = $resp->getData()["ID"];
                    $_SESSION["name"] = $name;
                    $_SESSION["username"] = $username;
                }
            }
        }
    }
    else
    {
        $resp->setMsg("Metodo de peticion no autorizado!");
    }

    $resp->send();

?>