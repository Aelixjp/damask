<?php

    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";
    require_once __DIR__ . "/../models/pagina.php";
    require_once __DIR__  . "/../CRUD/CRUD.php";

    class DAOPagina
    {
        private string $tb = "paginas";
        private PDO $conn;

        function __construct(PDO $conn)
        {
            $this->conn = $conn;
            $this->CRUD = new CRUD($this->conn);
        }

        public function getPage(int $id) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $query = $this->CRUD->READ("*", $this->tb, "ID = ?", $id);

            if(!$query->getStatus())
            {
                $resp = new Response();

                $resp->setMsg("Ha ocurrido un error al obtener la información!");
            }
            else
            {
                $page = new Pagina(); 
                
                $pg = $query->getData()[0]; extract($pg);

                $page->setID($ID)
                     ->setNombre($nombre)
                     ->setUrl($url)
                     ->setStatus($status);

                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($page);
            }

            return $resp;
        }

        public function getPages()
        {
            $resp = new ExtendedResponse();

            $query = $this->CRUD->READ("*", $this->tb);

            if(!$query->getStatus())
                return $query;
            else
            {
                foreach($query->getData() as $page)
                {
                    $page_e = new Pagina(); extract($page);

                    $page_e->setID($ID)
                           ->setNombre($nombre)
                           ->setUrl($url)
                           ->setStatus($status);

                    $resp->pushData($page_e->toAssocArray());
                }
                        
                $resp->setMsg("OK")
                     ->setStatus(true);
            }

            return $resp;
        }

    }

?>