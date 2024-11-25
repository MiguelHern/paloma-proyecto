<?php
include('../controller/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);

    $idP = $data['idP'];
    $statusPe = $data['statusPe'];

    try {
        $sql = "UPDATE pedido SET statusPe = ? WHERE idP = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('ii', $statusPe, $idP);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se actualizó ningún pedido.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

function obtenerPedidos()
{
    global $conexion;

    $sql = "SELECT 
                p.idP, 
                p.statusPe, 
                prod.nombre AS producto_nombre, 
                dp.cantidad, 
                dp.subtotal, 
                p.total
            FROM pedido p
            INNER JOIN detalle_pedido dp ON p.idP = dp.idP
            INNER JOIN producto prod ON dp.idPr = prod.idPr
            ORDER BY p.idP";

    $result = $conexion->query($sql);

    $pedidos = [];
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = [
            'idP' => $row['idP'],
            'statusPe' => $row['statusPe'],
            'nombre' => $row['producto_nombre'],
            'cantidad' => $row['cantidad'],
            'subtotal' => $row['subtotal'],
            'total' => $row['total']
        ];
    }

    return $pedidos;
}
