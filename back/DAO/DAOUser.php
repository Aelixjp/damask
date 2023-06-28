<?php

    require_once __DIR__  . "/../classes/response.php";
    require_once __DIR__  . "/../classes/extendedResponse.php";
    require_once __DIR__ . "/../models/user.php";
    require_once __DIR__  . "/../CRUD/CRUD.php";

    class DAOUser
    {
        private string $tb = "users";
        private PDO $conn;

        function __construct(PDO $conn)
        {
            $this->conn = $conn;
            $this->CRUD = new CRUD($this->conn);
        }

        public function getUser(int $ID) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $userQuery = $this->CRUD->READ("*", $this->tb, "ID = ?", $ID);

            if(!$userQuery->getStatus())
                return $userQuery;
            else
            {
                $user = new User();

                $usr = $userQuery->getData()[0]; extract($usr);
                    
                $user->setID($ID)
                     ->setName($name)
                     ->setEmail($email)
                     ->setUsername($username)
                     ->setPassword($password);
                        
                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($user);
            }

            return $resp;
        }

        public function getUserByUsername(string $username) : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $userQuery = $this->CRUD->READ(
                "ID, name, email, username", $this->tb, "username = ?", $username
            );

            if(!$userQuery->getStatus())
                return $userQuery;
            else
            {
                $user = new User();

                $usr = $userQuery->getData()[0]; extract($usr);
                    
                $user->setID($ID)
                     ->setName($name)
                     ->setEmail($email)
                     ->setUsername($username);
                        
                $resp->setMsg("OK")
                     ->setStatus(true)
                     ->setData($user);
            }

            return $resp;
        }

        public function getUsers() : Response | ExtendedResponse
        {
            $resp = new ExtendedResponse();

            $userQuery = $this->CRUD->READ("*", $this->tb);

            if(!$userQuery->getStatus())
                return $userQuery;
            else
            {
                foreach($userQuery->getData() as $user)
                {
                    $user_e = new User(); extract($user);

                    $user_e->setID($ID)
                           ->setEmail($email)
                           ->setName($name)
                           ->setUsername($username)
                           ->setPassword($password);

                    $resp->pushData($user_e->toAssocArray());
                }
                        
                $resp->setMsg("OK")
                     ->setStatus(true);
            }

            return $resp;
        }

        public function addUser(User $user) : Response | ExtendedResponse
        {
            $resp;
            $data = $user->toAssocArrayWithPass(); unset($data["ID"]); extract($data);

            try {
                $resp = $this->CRUD->CREATE(
                    $this->tb, "name, email, username, password", $name, $email, $username, $password
                );

                if($resp->getStatus())
                    $resp->setMsg("Usuario creado con exito!");
            } catch (\Throwable $th) {
                $resp = new Response();
                $resp->setMsg("El usuario ya existe!");
            }

            return $resp;
        }

    }

?>