<?php

    header("Access-Control-Allow-Origin: localhost");

    function checkSessionStarted()
    {
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        if(!empty($_SESSION))
        {
            if(isset($_SESSION["username"]))
                if(!empty($_SESSION["username"]))
                    return true;

        }

        return false;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        header("Content-Type: application/json; charset=utf-8");

        echo json_encode(["status" => checkSessionStarted()]);
    }
    else
    {
        if(!checkSessionStarted())
            header("Location: /damask");
    }

?>