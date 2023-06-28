<?php

    require_once __DIR__ . "/../interfaces/Serializable.php";
    require_once __DIR__ . "/../classes/SerializableObject.php";

    class EmailToken extends SerializableObject implements SerializableInterface
    {
        private int $ID;
        private string $email;
        private string $token;

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

        public function getEmail() : string
        {
            return $this->email;
        }

        public function setEmail(string $email)
        {
            $this->email = $email;

            return $this;
        }

        public function getToken() : string
        {
            return $this->token;
        }

        public function setToken(string $token)
        {
            $this->token = $token;

            return $this;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

        public function toAssocArray() : array
        {
            return [
                "ID" => $this->ID,
                "email" => $this->email,
                "token" =>$this->token
            ];
        }

    }

?>