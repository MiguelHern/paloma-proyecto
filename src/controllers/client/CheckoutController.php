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
    $idU = isset($_POST['idU']) ? $_POST['idU'] : null;

    if (!$nombreC || $total <= 0 || !$idU) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit;
    }

    try {
        // Conexión a la base de datos
        $conn = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insertar en la tabla pedido
        $sql = "INSERT INTO pedido (fecha, hora, total, statusPe, statusPa, nombreC, idU)
                VALUES (CURDATE(), CURTIME(), :total, 1, :statusPa, :nombreC, :idU)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':statusPa', $statusPa);
        $stmt->bindParam(':nombreC', $nombreC);
        $stmt->bindParam(':idU', $idU);
        $stmt->execute();

        // Obtener el idP del pedido insertado
        $idP = $conn->lastInsertId();

        // Insertar en la tabla detalle_pedido
        $detalles = $_POST['detalle']; // Recibir los detalles del pedido
        foreach ($detalles as $detalle) {
            $sqlDetalle = "INSERT INTO detalle_pedido (idP, idPr, cantidad, subtotal)
                           VALUES (:idP, :idPr, :cantidad, :subtotal)";
            $stmtDetalle = $conn->prepare($sqlDetalle);
            $stmtDetalle->bindParam(':idP', $idP);
            $stmtDetalle->bindParam(':idPr', $detalle['idPr']);
            $stmtDetalle->bindParam(':cantidad', $detalle['cantidad']);
            $stmtDetalle->bindParam(':subtotal', $detalle['subtotal']);
            $stmtDetalle->execute();
        }

        // Respuesta exitosa
        echo json_encode(['success' => true]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

