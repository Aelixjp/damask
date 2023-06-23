<?php

    require_once __DIR__ . "/../interfaces/Serializable.php";
    require_once __DIR__ . "/../classes/SerializableObject.php";

    class Pagina extends SerializableObject implements SerializableInterface
    {
        private int $ID;
        private string $nombre;
        private string $url;
        private bool $status;

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

        public function getNombre() : string
        {
            return $this->nombre;
        }

        public function setNombre(string $nombre)
        {
            $this->nombre = $nombre;

            return $this;
        }

        public function getUrl() : string
        {
            return $this->url;
        }

        public function setUrl(string $url)
        {
            $this->url = $url;
            
            return $this;
        }

        public function getStatus() : bool
        {
            return $this->status;
        }

        public function setStatus(bool $status)
        {
            $this->status = $status;

            return $this;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

        public function toAssocArray() : array
        {
            return [
                "ID" => $this->ID,
                "nombre" => $this->nombre,
                "url" => $this->url,
                "status" => $this->status
            ];
        }

    }

?>