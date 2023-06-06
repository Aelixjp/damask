<?php
    header('Access-Control-Allow-Origin: localhost');

	/*******************************************DATOS DE CONEXION DE LA BASE DE DATOS*******************************************/
	if(!defined("DATOS_CONEXION")){
		define("DB_HOST_NAME", 'localhost');
		define("DB_USERNAME", "root");
		define("DB_PASSWORD", "CP69775WD");
		define("DB_NAME", "damask");
		define("DATOS_CONEXION", array(DB_HOST_NAME, DB_NAME, DB_USERNAME, DB_PASSWORD));
	}

?>