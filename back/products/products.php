<?php
    header("Access-Control-Allow-Origin: localhost");

    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../DAO/DAOProduct.php";

    function getUserProduct($userID, $productID)
    {
        global $conn;

        $daoProduct = new DAOProduct($conn);
        
        return $daoProduct->getUserProduct($userID, $productID);
    }

    function getUserProducts($userID)
    {
        global $conn;

        $daoProduct = new DAOProduct($conn);
        
        return $daoProduct->getUserProducts($userID);
    }

?>