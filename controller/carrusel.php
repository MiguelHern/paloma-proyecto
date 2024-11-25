<?php
include('../controller/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $idP = intval($_GET['id']);
        header('Content-Type: application/json');

        try {
            $sql = "DELETE FROM detalle_pedido WHERE idP = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $idP);
            $stmt->execute();

            $sql = "DELETE FROM pedido WHERE idP = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param('i', $idP);
            $stmt->execute();

            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }
}

function obtenerPedidos()
{
    global $conexion;

    $sql = "SELECT p.idP, p.statusPe, prod.nombre, p.nombreC, dp.cantidad, dp.subtotal, p.total
            FROM pedido p
            INNER JOIN detalle_pedido dp ON p.idP = dp.idP
            INNER JOIN producto prod ON dp.idPr = prod.idPr
            ORDER BY p.idP";

    $result = $conexion->query($sql);

    $pedidos = [];
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }

    return $pedidos;
}
