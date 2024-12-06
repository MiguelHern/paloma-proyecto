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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if ($action === 'updateStatus') {
            // Obtener datos del cuerpo de la solicitud
            $data = json_decode(file_get_contents("php://input"), true);

            if (isset($data['idP']) && isset($data['statusPe'])) {
                $idP = intval($data['idP']);
                $statusPe = intval($data['statusPe']);

                try {
                    // Actualizar el estado del pedido
                    $sql = "UPDATE pedido SET statusPe = ? WHERE idP = ?";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bind_param('ii', $statusPe, $idP);
                    $stmt->execute();

                    // Responder con éxito
                    echo json_encode(['success' => true]);
                } catch (Exception $e) {
                    // Responder en caso de error
                    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                }
            } else {
                // Respuesta si faltan datos
                echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            }
            exit;
        }
    }
}
