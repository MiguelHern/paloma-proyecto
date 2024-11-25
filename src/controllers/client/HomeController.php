<?php

// Cargar configuración
$config = require 'config/config.php';

// Conexión a la base de datos
$dbConfig = $config['settings']['db'];
$dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}";
try {
    $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener todos los productos
    $stmt = $conn->query("SELECT * FROM producto ORDER BY nombre");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar productos por nombre
    $productosAgrupados = [];
    foreach ($productos as $producto) {
        $productosAgrupados[$producto['nombre']][] = $producto;
    }

    // Pasar los productos agrupados a la vista
    include 'views/client/home.php'; // Aquí incluye la vista donde los mostrarás
} catch (PDOException $e) {
    die("Error de conexión o consulta a la base de datos: " . $e->getMessage());
}
