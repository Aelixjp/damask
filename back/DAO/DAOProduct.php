<?php

    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";
    require_once __DIR__  . "/../models/product.php";
    require_once __DIR__  . "/../CRUD/CRUD.php";
    require_once __DIR__  . "/DAOPagina.php";
    require_once __DIR__  . "/DAOUser.php";

    class DAOProduct
    {
        private string $tb = "articulos_guardados";
        private PDO $conn;

        function __construct(PDO $conn)
        {
            $this->conn = $conn;
            $this->CRUD = new CRUD($this->conn);
            $this->daoUsr = new DAOUser($this->conn);
            $this->daoPag = new DAOPagina($this->conn);
        }

        public function getUserProduct(int $userID, int $productID) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $query = $this->CRUD->READ(
                "*", $this->tb, 
                "ID_usuario = ? AND ID = ?", 
                $userID, $productID
            );

            if(!$query->getStatus())
            {
                $resp = new Response();

                $resp->setMsg("Ha ocurrido un error al obtener la información!");
            }
            else
            {
                $page = new Pagina();
                $user = new User();
                $product = new Product();
                
                $prdct = $query->getData()[0]; extract($prdct);

                if(empty($prdct))
                    $resp = $query;
                else
                {
                    $qpage = $this->daoPag->getPage($ID_pagina);
                    $quser = $this->daoUsr->getUser($ID_usuario);

                    if(!$qpage->getStatus() || !$quser->getStatus())
                    {
                        $resp = new Response();

                        $resp->setMsg("Ha ocurrido un error al obtener la información!");
                    }
                    else
                    {
                        $page_data = $qpage->getData();
                        $page_user = $quser->getData();

                        $product->setID($ID)
                                ->setUser($page_user)
                                ->setUrl($url)
                                ->setNombreProducto($nombre_producto)
                                ->setImagenProducto($imagen_producto)
                                ->setPrecioProducto($precio_producto)
                                ->setPagina($page_data)
                                ->setResenaProducto($resena_producto);

                        $resp->setMsg("OK")
                             ->setStatus(true)
                             ->setData($product);
                    }
                }
            }

            return $resp;
        }

        public function getUserProducts(int $userID) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();


            /**
             * ID_pagina
             * ID_producto
             * e_commerce,
             * url_e_commerce,
             * url_articulo,
             * e_commerce_status,
             * nombre_producto
            */

            $customQuery = "SELECT
                paginas.ID as ID_pagina,
                articulos_guardados.ID as ID_producto,
                paginas.nombre as e_commerce,
                paginas.url as url_e_commerce,
                articulos_guardados.url as url_articulo,
                paginas.status as e_commerce_status,
                articulos_guardados.nombre_producto,
                articulos_guardados.imagen_producto,
                articulos_guardados.precio_producto,
                articulos_guardados.resena_producto
            FROM articulos_guardados
                LEFT JOIN users ON users.ID = articulos_guardados.ID
                LEFT JOIN paginas ON paginas.ID = articulos_guardados.ID_pagina 
            WHERE articulos_guardados.ID_usuario = ? ORDER BY articulos_guardados.ID";

            $query = $this->CRUD->READCustom($customQuery, $userID);

            if(!$query->getStatus())
            {
                $resp = new Response();

                $resp->setMsg("Ha ocurrido un error al obtener la información!");
            }
            else
            {
                foreach($query->getData() as $product)
                {
                    $pagina = new Pagina();
                    $product_e = new Product();

                    extract($product);

                    $pagina->setID($ID_pagina)
                           ->setNombre($e_commerce)
                           ->setUrl($url_e_commerce)
                           ->setStatus($e_commerce_status);

                    $product_e->setID($ID_producto)
                              ->setUrl($url_articulo)
                              ->setNombreProducto($nombre_producto)
                              ->setImagenProducto($imagen_producto)
                              ->setPrecioProducto($precio_producto)
                              ->setPagina($pagina)
                              ->setResenaProducto($resena_producto);

                    $resp->pushData($product_e->toAssocArrayWithoutUser());
                }
            }

            return $resp;
        }

        public function addUserProduct($productData) : Response | ExtendedResponse
        {
            $user = new User();
            $pagina = new Pagina();
            $product = new Product();
            $resp = new ExtendedResponse();

            $user->setID($productData["ID_usuario"]);
            $pagina->setID($productData["ID_pagina"]);
            
            $product->setPagina($pagina)
                    ->setUser($user)
                    ->setUrl($productData["url"])
                    ->setNombreProducto($productData["nombre_producto"])
                    ->setImagenProducto($productData["imagen_producto"])
                    ->setPrecioProducto($productData["precio_producto"])
                    ->setResenaProducto($productData["resena_producto"]);

            try {
                $resp = $this->CRUD->CREATE(
                    $this->tb, 
                    "ID_usuario, url, nombre_producto, imagen_producto, precio_producto, ID_pagina, resena_producto", 
                    $product->getUser()->getID(),
                    $product->getUrl(),
                    $product->getNombreProducto(),
                    $product->getImagenProducto(),
                    $product->getPrecioProducto(),
                    $product->getPagina()->getID(),
                    $product->getResenaProducto()
                );

                if($resp->getStatus())
                    $resp->setMsg("Guardado con exito!");
            } catch (\Throwable $th) {
                $resp = new Response();
                $resp->setMsg($th->getMessage());
            }

            return $resp;
        }

    }

?>