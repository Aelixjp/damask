<?php

    class User
    {
        private int $ID;
        private string $name;
        private string $username;
        private string $password; 

        function __construct(){}

        /********************************** GETTERS Y SETTERS **********************************/
        public function getID() : int
        {
            return $this->ID;
        }

        public function setID(int $ID)
        {
            $this->ID = $ID;
        }

        public function getName() : string
        {
            return $this->name;
        }

        public function setName(string $name)
        {
            $this->name = $name;
        }

        public function getUsername() : string
        {
            return $this->username;
        }

        public function setUsername(string $username)
        {
            $this->username = $username;
        }

        public function getPassword() : string
        {
            return $this->password;
        }

        public function setPassword(string $password)
        {
            $this->$password = $password;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/
    }

?>