<?php

    require_once __DIR__ . "/../interfaces/Serializable.php";
    require_once __DIR__ . "/../classes/SerializableObject.php";

    class User extends SerializableObject implements SerializableInterface
    {
        private int $ID = 0;
        private string $name;
        private string $email;
        private string $username;
        private string $password; 

        function __construct()
        {
            parent::__construct();
        }

        /********************************** GETTERS Y SETTERS **********************************/
        public function getID() : int
        {
            return $this->ID;
        }

        public function setID(int $ID)
        {
            $this->ID = $ID;

            return $this;
        }

        public function getName() : string
        {
            return $this->name;
        }

        public function setName(string $name)
        {
            $this->name = $name;

            return $this;
        }

        public function getEmail() : string
        {
            return $this->email;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;

            return $this;
        }

        public function getUsername() : string
        {
            return $this->username;
        }

        public function setUsername(string $username)
        {
            $this->username = $username;

            return $this;
        }

        public function getPassword() : string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->password = $password;

            return $this;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

        public function toAssocArray() : array
        {
            return [
                "ID" => $this->ID,
                "name" => $this->name,
                "email" => $this->email,
                "username" => $this->username
            ];
        }

        public function toAssocArrayWithPass() : array
        {
            return [
                "ID" => $this->ID,
                "name" => $this->name,
                "email" => $this->email,
                "password" => $this->password,
                "username" => $this->username
            ];
        }

    }

?>