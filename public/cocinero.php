<?php
include('../controller/carrusel.php');

$pedidos = obtenerPedidos();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos - Cocinero</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <aside class="w-1/5 bg-white shadow-md">
            <div class="p-4 font-bold text-lg">PalomaApp</div>
            <ul>
                <li class="py-2 px-4 hover:bg-gray-200 cursor-pointer">Pedidos</li>
            </ul>
        </aside>

        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-4">Pedidos</h1>

            <div class="overflow-x-auto">
                <div class="flex gap-4">
                    <?php if (!empty($pedidos)) : ?>
                        <?php foreach ($pedidos as $pedido) : ?>
                            <div class="bg-white shadow-md rounded-md p-4 w-72 flex-shrink-0">
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-bold">Pedido #<?= $pedido['idP'] ?></h2>
                                    <button onclick="openDeleteModal(<?= $pedido['idP'] ?>)" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">Producto: <?= $pedido['nombre'] ?></p>
                                <p class="text-sm text-gray-700 mb-2">Cliente: <?= htmlspecialchars($pedido['nombreC']) ?></p>
                                <p class="text-sm text-gray-700">Cantidad: <?= $pedido['cantidad'] ?></p>
                                <p class="text-sm text-gray-700">Subtotal: $<?= number_format($pedido['subtotal'], 2) ?></p>
                                <p class="text-sm text-gray-700">Total: $<?= number_format($pedido['total'], 2) ?></p>
                                <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" onclick="openModal(<?= $pedido['idP'] ?>, <?= $pedido['statusPe'] ?>)">Ver estado</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No hay pedidos disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de estado -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Estado del Pedido</h2>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center w-full space-x-4">
                    <button onclick="updateProgress(1)" id="step-1" class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center focus:outline-none">1</button>
                    <div class="flex-1 bg-gray-200 h-1 relative">
                        <div id="progress-bar-1" class="absolute top-0 left-0 h-1 bg-blue-500 hidden transition-all"></div>
                    </div>
                    <button onclick="updateProgress(2)" id="step-2" class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center focus:outline-none">2</button>
                    <div class="flex-1 bg-gray-200 h-1 relative">
                        <div id="progress-bar-2" class="absolute top-0 left-0 h-1 bg-blue-500 hidden transition-all"></div>
                    </div>
                    <button onclick="updateProgress(3)" id="step-3" class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center focus:outline-none">3</button>
                </div>
            </div>

            <div class="flex justify-between text-center text-sm text-gray-500">
                <div>Orden enviada</div>
                <div>Preparando</div>
                <div>Listo</div>
            </div>

            <div class="text-right mt-4">
                <button class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">¿Eliminar pedido?</h2>
            <p class="text-gray-700 mb-6">Esta acción eliminará el pedido y todos los productos asociados.</p>
            <div class="flex justify-end">
                <button onclick="closeDeleteModal()" class="bg-gray-300 px-4 py-2 rounded-md hover:bg-gray-400 mr-4">Cancelar</button>
                <button id="confirmDeleteButton" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Eliminar</button>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let orderId = null;

        function openModal(id, statusPe) {
            orderId = id;
            currentStep = statusPe;
            modal.classList.remove("hidden");
            initializeProgress(currentStep);
        }

        function closeModal() {
            modal.classList.add("hidden");
        }

        function openDeleteModal(id) {
            orderId = id;
            document.getElementById("deleteModal").classList.remove("hidden");
            document.getElementById("confirmDeleteButton").onclick = confirmDelete;
        }

        function closeDeleteModal() {
            document.getElementById("deleteModal").classList.add("hidden");
        }

        function confirmDelete() {
            fetch('../controller/carrusel.php?action=delete&id=' + orderId, {
                method: 'POST'
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarga la página para actualizar la lista de pedidos
                    } else {
                        console.error('Error al eliminar el pedido:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function initializeProgress(step) {
            const progressBar1 = document.getElementById("progress-bar-1");
            const progressBar2 = document.getElementById("progress-bar-2");
            const step1 = document.getElementById("step-1");
            const step2 = document.getElementById("step-2");
            const step3 = document.getElementById("step-3");

            [step1, step2, step3].forEach((el) => {
                el.classList.remove("bg-blue-500", "text-white");
                el.classList.add("bg-gray-300", "text-gray-500");
            });

            progressBar1.style.width = "0%";
            progressBar2.style.width = "0%";
            progressBar1.classList.add("hidden");
            progressBar2.classList.add("hidden");

            if (step >= 2) {
                progressBar1.style.width = "100%";
                progressBar1.classList.remove("hidden");
            }
            if (step === 3) {
                progressBar2.style.width = "100%";
                progressBar2.classList.remove("hidden");
            }

            for (let i = 1; i <= step; i++) {
                const currentStepButton = document.getElementById(`step-${i}`);
                currentStepButton.classList.remove("bg-gray-300", "text-gray-500");
                currentStepButton.classList.add("bg-blue-500", "text-white");
            }
        }

        function updateProgress(step) {
            currentStep = step;

            initializeProgress(step);

            fetch('../controller/carrusel.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ idP: orderId, statusPe: step }),
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        console.error('Error al actualizar el estado:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
