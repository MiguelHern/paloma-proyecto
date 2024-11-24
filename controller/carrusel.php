<?php
include('conexion.php'); // Incluir la conexión a la base de datos

// Función para obtener los pedidos con los productos relacionados
function obtenerPedidos() {
    global $conexion;

    $sql = "SELECT p.idP, pr.nombre, dp.cantidad, dp.subtotal, p.total, p.statusPe
            FROM detalle_pedido dp
            INNER JOIN pedido p ON dp.idP = p.idP
            INNER JOIN producto pr ON dp.idPr = pr.idPr";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $pedidos = [];
        while ($row = $resultado->fetch_assoc()) {
            $pedidos[] = $row;
        }
        return $pedidos;
    } else {
        return null;
    }
}

// Verificar si hay una solicitud POST para actualizar el estado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['idP']) && isset($data['statusPe'])) {
        $idP = $data['idP'];
        $statusPe = $data['statusPe'];

        $updateQuery = "UPDATE pedido SET statusPe = ? WHERE idP = ?";
        $stmt = $conexion->prepare($updateQuery);
        $stmt->bind_param("ii", $statusPe, $idP);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado']);
        }

        $stmt->close();
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        exit;
    }
}
?>
