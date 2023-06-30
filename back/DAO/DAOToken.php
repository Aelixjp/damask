<?php

    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";
    require_once __DIR__  . "/../utils/utils.php";
    require_once __DIR__  . "/../models/email_tokens.php";
    require_once __DIR__  . "/../CRUD/CRUD.php";

    class DAOToken
    {
        private string $tb = "email_tokens";
        private PDO $conn;
        private CRUD $CRUD;

        public function __construct(PDO $conn)
        {
            $this->conn = $conn;
            $this->CRUD = new CRUD($this->conn);
        }

        public function getTokenById(int $ID) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $tokenQuery = $this->CRUD->READ("*", $this->tb, "ID = ?", $ID);

            if(!$tokenQuery->getStatus())
                return $tokenQuery;
            else
            {
                $token = new EmailToken();

                $tok = $tokenQuery->getData()[0]; extract($tok);
                    
                $token->setID($ID)
                      ->setEmail($email)
                      ->setToken($token);
                        
                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($token);
            }

            return $resp;
        }

        public function getToken(string $token)
        {
            $resp = new ExtendedResponse();

            $tokenQuery = $this->CRUD->READ("*", $this->tb, "token = ?", $token);

            if(!$tokenQuery->getStatus())
            {
                return $tokenQuery;
            }
            else if(empty($tokenQuery->getData()))
            {
                $resp = new Response();

                $resp->setMsg("El token no existe o ha expirado!");
            }
            else
            {
                $emailToken = new EmailToken();

                $tok = $tokenQuery->getData()[0]; extract($tok);
                    
                $emailToken->setID($ID)
                           ->setEmail($email)
                           ->setToken($token);
                        
                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($emailToken);
            }

            return $resp;
        }

        public function getTokenByEmail(string $email) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $tokenQuery = $this->CRUD->READ("*", $this->tb, "email = ?", $email);

            if(!$tokenQuery->getStatus())
                return $tokenQuery;
            else
            {
                $token = new EmailToken();

                $tok = $tokenQuery->getData()[0]; extract($tok);
                    
                $token->setID($ID)
                      ->setEmail($email)
                      ->setToken($token);
                        
                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($token);
            }

            return $resp;
        }

        public function genTokenByEmail(string $email) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();
            $token = generateUUIDToken();

            try {
                $resp = $this->CRUD->CREATE($this->tb, "email, token", $email, $token);

                if($resp->getStatus())
                {
                    $ID = $resp->getData()["ID"];
                    
                    $resp->setData(["ID" => $ID, "token" => $token]);
                    $resp->setMsg("OK!");
                }

            } catch (\Throwable $th) {
                $resp = new Response();
                $resp->setMsg("Ha ocurrido un error al crear el token para cambio de contraseña!");
            }

            return $resp;
        }

        public function deleteTokensByEmail(string $email) : Response
        {
            $resp = new Response();

            $delQuery = $this->CRUD->DELETE($this->tb, "email = ?", $email);

            return $delQuery;
        }

    }

?>