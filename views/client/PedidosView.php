<?php
$pedidosPagados = [];
$pedidosEnProceso = [];

foreach ($pedidosAgrupados as $statusPa => $pedidosStatus) {
    foreach ($pedidosStatus as $pedido) {
        if ($pedido['statusPe'] === 3) {
            // Pedidos Pagados
            $pedidosPagados[] = $pedido;
        } else {
            // Pedidos En Proceso
            $pedidosEnProceso[] = $pedido;
        }
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
<header class="bg-white">
    <nav class="mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:gap-x-12 w-11/12 justify-center ">
            <!-- Primer enlace a /paloma-proyecto -->
            <a href="http://localhost/paloma-proyecto/" class="text-sm/6 font-semibold text-gray-900">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.01 10.22V14.71C2.01 19.2 3.81 21 8.3 21H13.69C18.18 21 19.98 19.2 19.98 14.71V10.22M11 11C12.83 11 14.18 9.51 14 7.68L13.34 1H8.67L8 7.68C7.82 9.51 9.17 11 11 11ZM17.31 11C19.33 11 20.81 9.36 20.61 7.35L20.33 4.6C19.97 2 18.97 1 16.35 1H13.3L14 8.01C14.17 9.66 15.66 11 17.31 11ZM4.64 11C6.29 11 7.78 9.66 7.94 8.01L8.64001 1H5.59C2.97001 1 1.97 2 1.61 4.6L1.34 7.35C1.14 9.36 2.62 11 4.64 11ZM11 16C9.33 16 8.5 16.83 8.5 18.5V21H13.5V18.5C13.5 16.83 12.67 16 11 16Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <!-- Segundo enlace a /paloma/carrito -->
            <a href="http://localhost/paloma-proyecto/carrito" class="text-sm/6 font-semibold text-gray-900">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1H2.74001C3.82001 1 4.67 1.93 4.58 3L3.75 12.96C3.61 14.59 4.89999 15.99 6.53999 15.99H17.19C18.63 15.99 19.89 14.81 20 13.38L20.54 5.88C20.66 4.22 19.4 2.87 17.73 2.87H4.82001M8 7H20M16.5 19.75C16.5 20.4404 15.9404 21 15.25 21C14.5596 21 14 20.4404 14 19.75C14 19.0596 14.5596 18.5 15.25 18.5C15.9404 18.5 16.5 19.0596 16.5 19.75ZM8.5 19.75C8.5 20.4404 7.94036 21 7.25 21C6.55964 21 6 20.4404 6 19.75C6 19.0596 6.55964 18.5 7.25 18.5C7.94036 18.5 8.5 19.0596 8.5 19.75Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>

            <a href="http://localhost/paloma-proyecto/pedidos" class="text-sm/6 font-semibold text-gray-900">
                <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:none;stroke:#020202;stroke-miterlimit:10;stroke-width:1.91px;}</style> </defs> <g id="handbag"> <path class="cls-1" d="M3.41,7.23H20.59a0,0,0,0,1,0,0v12a3.23,3.23,0,0,1-3.23,3.23H6.64a3.23,3.23,0,0,1-3.23-3.23v-12A0,0,0,0,1,3.41,7.23Z"></path> <path class="cls-1" d="M8.18,10.09V5.32A3.82,3.82,0,0,1,12,1.5h0a3.82,3.82,0,0,1,3.82,3.82v4.77"></path> </g> </g></svg>
            </a>
        </div>
        <div class="hidden lg:flex ">
            <a href="../../public/login.php" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
        </div>
    </nav>

    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-10"></div>
        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">

            <div class="flow-root">
                <div class="space-y-2 py-6">
                    <a href="../.." id="tienda-link" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                        Tienda
                    </a>
                    <a href="/shopping-bag" id="carrito-link" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                        Carrito
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="carroVacío" class="flex items-center justify-center h-screen bg-gray-100">
    <div class="text-center p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-700">Sin pedidos</h1>
        <p class="mt-2 text-gray-500">Parece que no hay pedidos pendientes.</p>
        <a
            href="http://localhost/paloma-proyecto/"
            class="block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
            Empezar a agregar
        </a>
    </div>
</div>

<main id="carroLleno" class="flex gap-6">
    <section id="pagos" class="orders mt-3 w-2/3">
        <div class="w-full">
            <header>
                <h2 class="ml-4 text-2xl font-semibold">Listos</h2>
            </header>
            <div class="relative overflow-hidden">
                <ul id="pedidos-pagados">
                    <?php foreach ($pedidosPagados as $pedido): ?>
                        <li class="p-4 rounded-lg pedido-item" data-nombre="<?php echo htmlspecialchars($pedido['nombreC']); ?>">
                            <h3 class="text-lg font-bold">Pedido de: <?php echo htmlspecialchars($pedido['nombreC']); ?></h3>
                            <p>Fecha: <?php echo date("d-m-Y", strtotime($pedido['fecha'])); ?></p>
                            <p>Hora: <?php echo $pedido['hora']; ?></p>
                            <p>Total: $<?php echo number_format($pedido['total'], 2); ?></p>
                            <p>Status de Pago: Pagado</p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Mostrar los pedidos En Proceso -->
            <header>
                <h2 class="ml-4 text-2xl font-semibold">En Proceso</h2>
            </header>
            <div class="relative overflow-hidden">
                <ul id="pedidos-en-proceso">
                    <?php foreach ($pedidosEnProceso as $pedido): ?>
                        <li class="p-4 rounded-lg pedido-item" data-nombre="<?php echo htmlspecialchars($pedido['nombreC']); ?>">
                            <h3 class="text-lg font-bold">Pedido de: <?php echo htmlspecialchars($pedido['nombreC']); ?></h3>
                            <p>Fecha: <?php echo date("d-m-Y", strtotime($pedido['fecha'])); ?></p>
                            <p>Hora: <?php echo $pedido['hora']; ?></p>
                            <p>Total: $<?php echo number_format($pedido['total'], 2); ?></p>
                            <p>Status de Pedido:
                                <?php echo match ($pedido['statusPe']) {
                                    1 => 'Pendiente',
                                    2 => 'Preparando',
                                    3 => 'Listo',
                                    default => 'Estado desconocido',
                                }; ?>
                            </p>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>


    </section>

</main>
<script>
    // Recupera el valor de 'nombre' desde sessionStorage
    let nombreCRecuperado = sessionStorage.getItem('nombre');

    // Selecciona todos los elementos con la clase 'pedido-item'
    let pedidos = document.querySelectorAll('.pedido-item');

    // Recorre los pedidos y muestra solo los que coincidan con el nombre recuperado
    pedidos.forEach(function (pedido) {
        pedido.style.display =
            pedido.getAttribute('data-nombre') === nombreCRecuperado ? '' : 'none';
    });

    // Verifica si hay algún pedido visible
    let hayPedidosVisibles = Array.from(pedidos).some(
        pedido => pedido.style.display !== 'none'
    );

    // Muestra u oculta las secciones según los pedidos visibles
    document.getElementById('carroLleno').style.display = hayPedidosVisibles ? '' : 'none';
    document.getElementById('carroVacío').style.display = hayPedidosVisibles ? 'none' : '';
</script>



</body>
</html>
