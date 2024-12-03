<?php
// Cargar configuración
$config = require 'config/config.php';
$dbConfig = $config['settings']['db'];
$dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']}";

// Si la solicitud es GET, mostrar los pedidos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        // Conexión a la base de datos
        $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Obtener todos los pedidos
        $stmt = $conn->query("SELECT * FROM pedido ORDER BY fecha DESC");
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agrupar pedidos por el estado de pago (statusPa)
        $pedidosAgrupados = [];
        foreach ($pedidos as $pedido) {
            $pedidosAgrupados[$pedido['statusPa']][] = $pedido;
        }

        // Mostrar la vista de pedidos
        include 'views/client/PedidosView.php';
    } catch (PDOException $e) {
        die("Error de conexión o consulta a la base de datos: " . $e->getMessage());
    }
}

// Si la solicitud es POST, insertar un nuevo pedido

