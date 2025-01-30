<?php

// Conexión a la base de datos

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'keyshield';
$port = 3307;

$db = mysqli_connect($server, $username, $password, $database, $port);

mysqli_query($db, "SET NAMES 'utf8'");



// INICIAR LA SESSIÓN 
if(!isset($_SESSION)){
	session_start();
}
?>