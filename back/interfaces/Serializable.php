<?php

    interface SerializableInterface
    {
        public function toAssocArray() : array;
        public function serialize(array $serializeData) : string;
    }

?>