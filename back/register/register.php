<?php 

    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__  . "/../DAO/DAOUser.php";
    require_once __DIR__  . "/../models/user.php";
    require_once __DIR__  . "/../classes/response.php";

    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=utf-8");

    $resp = new Response();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $user = new User();
        $DAOUser = new DAOUser($conn);

        if(!isset($_POST["name"]) || !isset($_POST["username"]) || !isset($_POST["password"]))
            $resp->setMsg("Se ha omitido informacion necesaria para crear un usuario!");
        else
        {
            $name     = $_POST["name"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            if(gettype($name) != "string" || gettype($username) != "string" || gettype($password) != "string")
            {
                $resp->setMsg("Los datos no tienen un formato adecuado, porfavor verifique!");
            }
            else if(empty(trim($name)) || empty(trim($username)) || empty(trim($password)))
            {
                $resp->setMsg("Hay ciertos datos vacios, porfavor verifique!");
            }
            else
            {
                $user->setName($name)
                     ->setUsername($username)
                     ->setPassword($password);

                $resp = $DAOUser->addUser($user);
            }
        }
    }
    else
    {
        $resp->setMsg("Metodo de peticion no autorizado!");
    }

    $resp->send();

?>