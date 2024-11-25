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
        include 'views/client/CheckoutView.php'; // Aquí incluye la vista donde los mostrarás
    } catch (PDOException $e) {
        die("Error de conexión o consulta a la base de datos: " . $e->getMessage());
    }
}

// Si la solicitud es POST, insertar un nuevo pedido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json'); // Asegurarnos de devolver JSON

    // Recibir datos
    $nombreC = isset($_POST['nombreC']) ? $_POST['nombreC'] : null;
    $total = isset($_POST['total']) ? $_POST['total'] : 0;
    $statusPa = isset($_POST['statusPa']) ? $_POST['statusPa'] : 1;

    if (!$nombreC || $total <= 0) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit;
    }

    try {
        // Conexión a la base de datos
        $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar en la base de datos
        $sql = "INSERT INTO pedido (fecha, hora, total, statusPe, statusPa, nombreC)
                VALUES (CURDATE(), CURTIME(), :total, 1, :statusPa, :nombreC)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':statusPa', $statusPa);
        $stmt->bindParam(':nombreC', $nombreC);
        $stmt->execute();

        // Respuesta exitosa
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}
