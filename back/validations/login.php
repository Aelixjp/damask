<?php
    session_start();

    require_once "../connection/connection.php";

    $msg = "";

    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : ""; 

    if(empty(trim($username)) || empty(trim($password)))
    {
        $msg = "Porfavor rellene todos los campos!";
    }else
    {
        $q = $conn -> prepare("SELECT * FROM users WHERE username = ? AND password = ?");

        if(!$q->execute([$username, $password]))
        {
            $msg = "Ha ocurrido un error al comprobar sus credenciales de inicio!";
        }else
        {
            $data = $q->fetchAll(PDO::FETCH_ASSOC);

            if(sizeof($data) <= 0)
            {
                $msg = "Inicio de sesión invalido!";
            }else
            {
                $dt = $data[0];

                $_SESSION["name"    ] = $dt["name"];
                $_SESSION["username"] = $dt["username"];

                echo "<script>window.location = '../../articles';</script>";
            }
        }
    }

    if(!empty($msg))
    {
        echo "<script>alert('$msg'); window.location = '../../index.html';</script>";
    }

?>