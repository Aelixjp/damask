<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $name     = isset($_SESSION["name"]    ) ? $_SESSION["name"]     : "";
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

    if(empty(trim($name)) || empty(trim($username)))
    {
        header("Location: " . APP_LOCAL);
    }

?>