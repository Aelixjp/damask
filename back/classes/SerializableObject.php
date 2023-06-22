<?php

    class SerializableObject
    {

        function __construct(){}

        public function serialize(array $serializeData) : string
        {
            return json_encode($serializeData);
        }

    }

?>