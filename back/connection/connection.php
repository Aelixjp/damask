<?php
    header('Access-Control-Allow-Origin: localhost');

	require_once "config.php";
	
	/**
		Conecta a la base de datos usando PDO, en caso de exito devuelve un objeto PDO, caso contrario devuelve un
		mensaje de error.
	*/
	function conectar($host, $DB, $user, $pass){

		try {
			return new PDO("mysql:host=$host;dbname=$DB;charset=utf8", $user, $pass);
		} catch (PDOException $e) {
			return $e->getMessage();
		}

	}

	//Conexion de la base de datos
	$conn = conectar(...DATOS_CONEXION);

?>