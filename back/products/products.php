<?php
    header("Access-Control-Allow-Origin: localhost");
    header("Access-Control-Allow-Methods: POST, DELETE");

    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../DAO/DAOProduct.php";
    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";

    $resp = new ExtendedResponse();
    $daoProduct = new DAOProduct($conn);

    function getUserProduct($userID, $productID)
    {
        global $conn;
        global $daoProduct;

        $daoProduct = new DAOProduct($conn);
        
        return $daoProduct->getUserProduct($userID, $productID);
    }

    function getUserProducts($userID)
    {
        global $conn;
        global $daoProduct;

        $daoProduct = new DAOProduct($conn);
        
        return $daoProduct->getUserProducts($userID);
    }

    function addUserProduct($productData)
    {
        global $daoProduct;

        return $daoProduct->addUserProduct($productData);
    }

    if(!($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "DELETE"))
        $resp->setMsg("Metodo de petición no valido!");
    else if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        header("Content-Type: application/json;charset=utf-8");

        $postDT = $_POST;

        if(!isset($postDT["action"]) || empty($postDT["action"]))
        {
            $resp = new Response();

            $resp->setMsg("Accion no especificada!");
        }
        else
        {
            $action = $postDT["action"];

            switch ($action) {
                case 'save-product':

                    if(
                        !isset($postDT["ID_usuario"     ]) || !isset($postDT["ID_pagina"      ]) ||
                        !isset($postDT["url"            ]) || !isset($postDT["nombre_producto"]) ||
                        !isset($postDT["imagen_producto"]) || !isset($postDT["precio_producto"]) ||
                        !isset($postDT["resena_producto"])
                    )
                    {
                        $resp = new Response();

                        $resp->setMsg("Ciertos datos requeridos no fueron enviados!");
                    }
                    else if(
                        empty(trim($postDT["ID_usuario"     ])) || empty(trim($postDT["ID_pagina"      ])) ||
                        empty(trim($postDT["url"            ])) || empty(trim($postDT["nombre_producto"])) ||
                        empty(trim($postDT["imagen_producto"])) || empty(trim($postDT["precio_producto"]))
                    )
                    {
                        $resp = new Response();

                        $resp->setMsg("Hay datos vacios!");
                    }
                    else
                    {
                        $id_usuario  = $postDT["ID_usuario"     ];
                        $id_pagina   = $postDT["ID_pagina"      ];
                        $URL         = $postDT["url"            ];
                        $nombre_prod = $postDT["nombre_producto"];
                        $imagen_prod = $postDT["imagen_producto"];
                        $precio_prod = $postDT["precio_producto"];
                        $review_prod = $postDT["resena_producto"];

                        $productData = [
                            "ID_usuario" => $id_usuario,
                            "ID_pagina" => $id_pagina,
                            "url" => $URL,
                            "nombre_producto" => $nombre_prod,
                            "imagen_producto" => $imagen_prod,
                            "precio_producto" => $precio_prod,
                            "resena_producto" => $review_prod
                        ];

                        $resp = addUserProduct($productData);
                    }

                    break;
                
                default:
                    $resp = new Response();

                    $resp->setMsg("Accion desconocida!");
                    break;
            }
        }

        $resp->send();
    }
    else if($_SERVER["REQUEST_METHOD"] === "DELETE")
    {
        header("Content-Type: application/json;charset=utf-8");
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $resp = new Response();

        if(!isset($_DELETE["id"]))
            $resp->setMsg("Producto a eliminar no especificado!");
        else if(empty($_DELETE["id"]))
            $resp->setMsg("Producto a eliminar no especificado!");
        else
        {
            $id = filter_var($_DELETE["id"], FILTER_SANITIZE_NUMBER_INT);

            if(!$id)
                $resp->setMsg("Valor no valido!");
            else
            {
                $resp = $daoProduct->deleteUserProduct($id);

                if(!$resp->getStatus())
                    $resp->setMsg("Ha ocurrido un error al eliminar el producto!");
                else
                {
                    $resp->setStatus(true);
                    $resp->setMsg("Eliminado de favoritos con exito!");
                }
            }
        }

        $resp->send();
    }

?>