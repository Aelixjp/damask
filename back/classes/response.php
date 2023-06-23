<?php

    require_once __DIR__ . "/../interfaces/Serializable.php";
    require_once __DIR__ . "/../classes/SerializableObject.php";

    class Response extends SerializableObject implements SerializableInterface
    {
        private bool $status = false;
        private string $msg;

        function __construct()
        {
            parent::__construct();
        }

        /********************************** GETTERS Y SETTERS **********************************/
        public function getStatus() : bool
        {
            return $this->status;
        }

        public function setStatus(bool $status)
        {
            $this->status = $status;

            return $this;
        }

        public function getMsg() : string
        {
            return $this->msg;
        }

        public function setMsg(string $msg)
        {
            $this->msg = $msg;

            return $this;
        }
        /******************************* FIN GETTERS Y SETTERS *******************************/

        public function toAssocArray() : array
        {
            return [
                "msg" => $this->msg,
                "status" => $this->status
            ];
        }

        public function send()
        {
            echo $this->serialize($this->toAssocArray());
        }

    }

?>