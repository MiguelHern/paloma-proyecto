<?php
include 'conexion.php';

if (isset($_GET['action']) && $_GET['action'] === 'pay') {
    header('Content-Type: application/json');

    $pedidoId = intval($_GET['id']);
    $method = $_GET['method'] ?? 'desconocido';

    try {
        $sql = "UPDATE pedido SET statusPa = 2 WHERE idP = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('i', $pedidoId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'method' => $method]);
        } else {
            echo json_encode(['success' => false, 'error' => 'No se pudo actualizar el estado del pedido.']);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    $conexion->close();
    exit;
}

try {
    $sql = "SELECT p.idP AS pedido_id, p.total, p.statusPa, dp.idPr AS producto_id, 
                   prod.nombre AS producto_nombre, prod.precioU AS producto_precio
            FROM pedido p
            INNER JOIN detalle_pedido dp ON p.idP = dp.idP
            INNER JOIN producto prod ON dp.idPr = prod.idPr
            WHERE p.statusPe = 3
            ORDER BY p.idP";

    $result = $conexion->query($sql);

    $pedidos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pedido_id = $row['pedido_id'];
            if (!isset($pedidos[$pedido_id])) {
                $pedidos[$pedido_id] = [
                    'id' => $pedido_id,
                    'total' => $row['total'],
                    'statusPa' => $row['statusPa'],
                    'productos' => []
                ];
            }
            $pedidos[$pedido_id]['productos'][] = [
                'nombre' => $row['producto_nombre'],
                'precio' => $row['producto_precio']
            ];
        }
    }

    foreach ($pedidos as $pedido) {
        $status_pago = $pedido['statusPa'] == 2 ? "Pagado" : "Pendiente por pagar";
        $status_color = $pedido['statusPa'] == 2 ? "text-green-500" : "text-red-500";
        echo '
            <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition-shadow" data-id="' . $pedido['id'] . '">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pedido: ' . $pedido['id'] . '</h3>
                <ul class="text-gray-600 text-sm space-y-2">';
        foreach ($pedido['productos'] as $producto) {
            echo '<li>' . $producto['nombre'] . ': $' . number_format($producto['precio'], 2) . '</li>';
        }
        echo '
                </ul>
                <div class="mt-4">
                    <p class="font-medium text-gray-800">Total: $' . number_format($pedido['total'], 2) . '</p>
                    <p class="mt-2 text-sm payment-status ' . $status_color . ' font-medium">' . $status_pago . '</p>';
        if ($pedido['statusPa'] != 2) {
            echo '
                    <button onclick="openPaymentModal(' . $pedido['id'] . ', ' . $pedido['total'] . ')" 
                            class="payment-button mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        <i class="fas fa-credit-card"></i> Pagar
                    </button>';
        }
        echo '
                </div>
            </div>';
    }
} catch (Exception $e) {
    echo '<div class="bg-red-100 text-red-700 p-4 rounded-md">Error: ' . $e->getMessage() . '</div>';
}
?>
