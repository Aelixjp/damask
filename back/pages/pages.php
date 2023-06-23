<?php
    ini_set("display_errors", E_ALL);

    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Origin: localhost");
    
    require_once __DIR__ . "/../models/pagina.php";
    require_once __DIR__ . "/../classes/response.php";
    require_once __DIR__ . "/../classes/extendedResponse.php";
    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../DAO/DAOPagina.php";

    function getPages() : array
    {
        global $conn;

        $pages = [];
        $daoPag = new DAOPagina($conn);
        $respPages = $daoPag->getPages();

        if($respPages->getStatus())
            $pages = $respPages->getData();

        return $pages;
    }

    function checkAction(string $action) : Response | ExtendedResponse
    {
        global $conn;

        $resp = new Response();
        $daoPag = new DAOPagina($conn);

        switch ($action) {
            case 'get-page':
                if(!isset($_GET["id"]))
                    $resp->setMsg("Id no especificado!");
                else if(empty($_GET["id"]))
                    $resp->setMsg("Id invalido!");
                else
                {
                    $id = $_GET["id"];

                    return $daoPag->getPage($id);
                }
                    
                break;

            case 'get-pages':
                header("Content-Type: application/json; charset=utf8");

                $respPages = $daoPag->getPages();
                $respPages->send();

                return $respPages;
            
            default:
                $resp->setMsg("Acción no valida!");
                break;
        }

        return $resp;
    }

    function checkMethod() : Response | ExtendedResponse
    {
        $resp = new Response();

        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            if(!isset($_GET["action"]))
                $resp->setMsg("Acción no especificada!");
            else
            {
                $action = $_GET["action"];

                if(empty($action))
                    $resp->setMsg("Acción no valida!");
                else
                    return checkAction($action);
            }
        }
        else
            $resp->setMsg("Metodo de petición no admitido!");

        return $resp;
    }

    function init()
    {
        checkMethod();
    }

    init();

?>