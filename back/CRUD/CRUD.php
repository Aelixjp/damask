<?php

    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";

    class CRUD
    {
        private PDO $conn;

        function __construct(PDO $conn)
        {
            $this->conn = $conn;
        }

        function CREATE($tb, $fields, ...$values) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            if(!$this->conn)
            {
                $resp = new Response();
                $resp->setMsg("No hay conexion a la BD!");
            }
            else
            {
                $q = "INSERT INTO $tb ($fields) VALUES (";
                
                for($i = 0; $i < count($values); $i++)
                    $q = $i != count($values) - 1 ? $q . "?, " : $q . "?";

                $q .= ")";

                $query = $this->conn->prepare($q);

                if(!$query->execute($values))
                {
                    $resp = new Response();
                    $resp->setMsg("Ha ocurrido un error al ejecutar la consulta!");
                }
                else
                {   
                    $q2 = $this->conn->query("SELECT LAST_INSERT_ID() as ID");

                    $resp->setStatus(true)
                         ->setMsg("OK")
                         ->setData($q2->fetch(PDO::FETCH_ASSOC));
                }
            }

            return $resp;
        }

        function READ($fields = "*", $tb, $where_cond = false, ...$where_cond_vals) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            if(!$this->conn)
            {
                $resp = new Response();
                $resp->setMsg("No hay conexion a la BD!");
            }
            else
            {
                $q = "SELECT $fields FROM $tb";
                $q = $where_cond ? $q . " WHERE $where_cond" : $q;

                $query = $this->conn->prepare($q);

                if(!$where_cond)
                {
                    if(!$query->execute())
                    {
                        $resp = new Response();
                        $resp->setMsg("Ha ocurrido un error al ejecutar la consulta!");
                    }
                    else
                    {
                        $data = $query->fetchAll(PDO::FETCH_ASSOC);

                        $resp->setStatus(true)
                             ->setData($data);

                        if(empty($data))
                            $resp->setMsg("No hay datos para devolver!");
                        else
                            $resp->setMsg("OK");
                    }
                }
                else if(!$query->execute($where_cond_vals))
                {
                    $resp = new Response();
                    $resp->setMsg("Ha ocurrido un error al ejecutar la consulta!");
                }
                else
                {
                    $data = $query->fetchAll(PDO::FETCH_ASSOC);

                    $resp->setStatus(true)
                         ->setData($data);

                    if(empty($data))
                        $resp->setMsg("No hay datos para devolver!");
                    else
                        $resp->setMsg("OK");
                }
            }

            return $resp;
        }
    
        function UPDATE()
        {

        }

        function DELETE()
        {

        }

    }

?>