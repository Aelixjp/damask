<?php

    define("ROOT_URL"      , $_SERVER["DOCUMENT_ROOT"]);
    define("APP_URL"       , ROOT_URL . "/" . "damask");

    define("ROOT_LOCAL", $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . ":" . $_SERVER["SERVER_PORT"]);
    define("APP_LOCAL" , ROOT_LOCAL . "/" . "damask");
    
    define("FRAMEWORKS_URL", APP_URL  . "/" . "frameworks");
    define("FRAMEWORKS_URL_LOCAL", APP_LOCAL . "/" . "frameworks");

    define("LIBRARIES_URL"      , APP_URL   . "/" . "libraries");
    define("LIBRARIES_URL_LOCAL", APP_LOCAL . "/" . "libraries");

?>