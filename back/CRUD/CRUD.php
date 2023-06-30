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
            else if(empty(trim($tb)))
                $resp->setMsg("No se ha especificado la tabla para la operación, no se procedera!");
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
            else if(empty(trim($tb)))
                $resp->setMsg("No se ha especificado la tabla para la operación, no se procedera!");
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
    
        function UPDATE(string $tb, string $params, string $cond, ...$vals) : Response
        {
            $resp = new Response();

            if(!$this->conn)
                $resp->setMsg("No hay conexion a la BD!");
            else if(empty(trim($tb)))
                $resp->setMsg("No se ha especificado la tabla para la operación, no se procedera!");
            else if(empty(trim($params)))
                $resp->setMsg("Parametros a actualizar no especificados!, no se procedera!");
            else if(empty(trim($cond)))
                $resp->setMsg("No se ha especificado una condicion para actualización, no se procedera!");
            else if(empty($vals))
                $resp->setMsg("Se requiere minimo un parametro para actualización!");
            else
            {
                $q = "UPDATE $tb SET $params WHERE $cond";

                $updateQuery = $this->conn->prepare($q);

                if(!$updateQuery->execute($vals))
                    $resp->setMsg("Ha fallado la consulta!");
                else
                {
                    $resp->setStatus(true);
                    $resp->setMsg("OK");
                }
            }

            return $resp;
        }

        function DELETE(string $tb, string $cond, ...$vals) : Response
        {
            $resp = new Response();

            if(!$this->conn)
                $resp->setMsg("No hay conexion a la BD!");
            else if(empty(trim($tb)))
                $resp->setMsg("No se ha especificado la tabla para la operación, no se procedera!");
            else if(empty(trim($cond)))
                $resp->setMsg("Condicion no especificada!, no se procedera!");
            else if(empty($vals))
                $resp->setMsg("Se requiere minimo un parametro para eliminacion!");
            else
            {
                $q = "DELETE FROM $tb WHERE $cond";

                $query = $this->conn->prepare($q);

                if(!$query->execute($vals))
                    $resp->setMsg("Ha fallado la consulta!");
                else
                {
                    $resp->setStatus(true);
                    $resp->setMsg("OK");
                }
            }

            return $resp;
        }

        function READCustom(string $customQuery, ...$values) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $query = $this->conn->prepare($customQuery);

            if(!$query->execute($values))
            {
                $resp = new Response();

                $resp->setMsg("Ha ocurrido un error al ejecutar la consulta!");
            }
            else
            {
                $respData = $query->fetchAll(PDO::FETCH_ASSOC);

                $resp->setStatus(true)->setData($respData);

                if(empty($respData))
                    $resp->setMsg("No hay coincidencias!");
                else
                    $resp->setMsg("OK");
            }

            return $resp;
        }

    }

?>