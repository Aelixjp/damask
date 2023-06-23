<?php

    require_once __DIR__ . "/user.php";

    class Product
    {
        private int $ID;
        private User $usuario;
        private string $nombre_producto;
        private string $imagen_producto;
        private string $precio_producto;
        private string $nombre_e_commerce;
        private string $categoria_producto;
        private string $producto_review;

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

        public function getUsuario() : Usuario
        {
            return $this->usuario;
        }

        public function setUsuario(Usuario $usuario)
        {
            $this->usuario = $usuario;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

    }

?>