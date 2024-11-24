<?php

$usuario = "root"; 
$password = "Diasaric5*";   
$servidor = "localhost"; 
$basededatos = "paloma"; 

// Crear una conexión a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $password, $basededatos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres UTF-8
mysqli_set_charset($conexion, "utf8");

?>
