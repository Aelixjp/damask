<?php

    function checkSessionStarted()
    {
        if(session_status() == PHP_SESSION_NONE)
            session_start();

        if(!empty($_SESSION))
        {
            if(isset($_SESSION["ID"]) && isset($_SESSION["username"]))
                if(!empty($_SESSION["ID"]) && !empty($_SESSION["username"]))
                    return true;

        }

        return false;
    }

    function checkAuthenticatedInDb($conn, $username, $password)
    {
        $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");

        if(!$query->execute([$username, hash("SHA512", $password)]))
            return false;
        else
        {
            $r = $query->fetchAll(PDO::FETCH_ASSOC);

            return $r;
        }

        return false;
    }

?>