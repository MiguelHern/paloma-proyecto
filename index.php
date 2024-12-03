<?php

// Cargar configuración
$config = require 'config/config.php';

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];
$baseUri = '/paloma-proyecto'; // Cambia al nombre de tu carpeta en htdocs
$route = str_replace($baseUri, '', $requestUri);
$route = trim($route, '/');

// Conexión a la base de datos
$dbConfig = $config['settings']['db'];
$dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}";
try {
    $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Manejar rutas
switch ($route) {
    case '':
    case 'home':
        require 'src/controllers/client/HomeController.php';
        break;

    case 'carrito':
        require 'src/controllers/client/CheckoutController.php';
        break;

        case 'pedidos':
        require 'src/controllers/client/PedidoController.php';
        break;
}
