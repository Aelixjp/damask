<?php

    require_once __DIR__ . "/response.php";

    class ExtendedResponse extends Response
    {
        private $data;

        function __construct()
        {
            parent::__construct();
        }

        public function getData()
        {
            return $this->data;
        }

        public function setData($data)
        {
            $this->data = $data;

            return $this;
        }

        public function pushData($data)
        {
            if(!$this->data)
                $this->data = [];
            
            array_push($this->data, $data);

            return $this;
        }

        public function toAssocArray() : array
        {
            return [
                "msg" => $this->getMsg(),
                "data" => gettype($this->data) != "array" ? $this->data->toAssocArray() : $this->data,
                "status" => $this->getStatus()
            ];
        }

    }

?>