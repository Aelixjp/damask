<?php

    require_once __DIR__ . "/../interfaces/Serializable.php";
    require_once __DIR__ . "/../classes/SerializableObject.php";
    require_once __DIR__ . "/user.php";
    require_once __DIR__ . "/pagina.php";

    class Product extends SerializableObject implements SerializableInterface
    {
        private int $ID;
        private User $usuario;
        private string $url;
        private string $nombre_producto;
        private string $imagen_producto;
        private string $precio_producto;
        private Pagina $pagina;
        private string $resena_producto;

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

        public function getUser() : User
        {
            return $this->usuario;
        }

        public function setUser(User $usuario)
        {
            $this->usuario = $usuario;

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

        public function getNombreProducto() : string
        {
            return $this->nombre_producto;
        }

        public function setNombreProducto(string $nombre_producto)
        {
            $this->nombre_producto = $nombre_producto;

            return $this;
        }

        public function getImagenProducto() : string
        {
            return $this->imagen_producto;
        }

        public function setImagenProducto(string $imagen_producto)
        {
            $this->imagen_producto = $imagen_producto;

            return $this;
        }

        public function getPrecioProducto() : string
        {
            return $this->precio_producto;
        }

        public function setPrecioProducto(string $precio_producto)
        {
            $this->precio_producto = $precio_producto;

            return $this;
        }

        public function getPagina() : Pagina
        {
            return $this->pagina;
        }

        public function setPagina(Pagina $pagina)
        {
            $this->pagina = $pagina;

            return $this;
        }

        public function getResenaProducto() : string
        {
            return $this->resena_producto;
        }

        public function setResenaProducto(string $resena_producto)
        {
            $this->resena_producto = $resena_producto;

            return $this;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

        public function toAssocArray() : array
        {
            return [
                "ID" => $this->ID,
                "usuario" => $this->usuario->toAssocArray(),
                "url" => $this->url,
                "nombre_producto" => $this->nombre_producto,
                "imagen_producto" => $this->imagen_producto,
                "precio_producto" => $this->precio_producto,
                "pagina" => $this->pagina->toAssocArray(),
                "resena_producto" => $this->resena_producto
            ];
        }

        public function toAssocArrayWithoutUser() : array
        {
            return [
                "ID" => $this->ID,
                "url" => $this->url,
                "nombre_producto" => $this->nombre_producto,
                "imagen_producto" => $this->imagen_producto,
                "precio_producto" => $this->precio_producto,
                "pagina" => $this->pagina->toAssocArray(),
                "resena_producto" => $this->resena_producto
            ];
        }

    }

?>