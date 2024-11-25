<?php
// Filtrar los pedidos en dos categorías: Pagados (statusPe = 3) y En Proceso (statusPe = 1 o 2)
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
    <link href="public/styles.css" rel="stylesheet">
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

            <!-- Segundo enlace a /paloma-proyecto/carrito -->
            <a href="http://localhost/paloma-proyecto/carrito" class="text-sm/6 font-semibold text-gray-900">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1H2.74001C3.82001 1 4.67 1.93 4.58 3L3.75 12.96C3.61 14.59 4.89999 15.99 6.53999 15.99H17.19C18.63 15.99 19.89 14.81 20 13.38L20.54 5.88C20.66 4.22 19.4 2.87 17.73 2.87H4.82001M8 7H20M16.5 19.75C16.5 20.4404 15.9404 21 15.25 21C14.5596 21 14 20.4404 14 19.75C14 19.0596 14.5596 18.5 15.25 18.5C15.9404 18.5 16.5 19.0596 16.5 19.75ZM8.5 19.75C8.5 20.4404 7.94036 21 7.25 21C6.55964 21 6 20.4404 6 19.75C6 19.0596 6.55964 18.5 7.25 18.5C7.94036 18.5 8.5 19.0596 8.5 19.75Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="hidden lg:flex ">
            <a href="public/login.php" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
        </div>
    </nav>

    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-10"></div>
        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">

            <div class="flow-root">
                <div class="space-y-2 py-6">
                    <a href="../" id="tienda-link" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
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
        <h1 class="text-2xl font-bold text-gray-700">Carro vacío</h1>
        <p class="mt-2 text-gray-500">Parece que aún no has agregado nada al carrito.</p>
        <a
                href="http://localhost/paloma-proyecto/"
                class="block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >
            Empezar a agregar
        </a>
    </div>
</div>

<main id="carroLleno" class="flex gap-6">
    <section id="pagos" class="orders mt-3 hidden w-2/3">
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
                            <p>Status de Pago:
                                <?php echo ($pedido['statusPa'] == 1) ? 'Pendiente' : 'En Proceso'; ?>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>


    </section>
    <section id="carritoIzquierdo" class="w-2/3">
        <div id="carrito-container">
            <ul id="carrito-lista"></ul>
        </div>
    </section>
    <section class="w-1/3 ">
        <div class="bg-white rounded-lg shadow-md w-full max-w-md">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4 flex justify-between items-center">
                    Resumen del pedido
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </h2>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <ul class="carrito-lista-pago"></ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between font-semibold">
                        <div >
                            <span>Total:(</span>
                            <span class="amountItems"></span>
                            <span>productos)</span>
                        </div>
                        <div>
                            <span>$</span>
                            <span class="total-h"></span>
                        </div>

                    </div>
                </div>
                <div id="botones-pago" class="flex gap-4">
                    <button id="pago-tarjeta" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
                        Pagar con tarjeta
                    </button>
                    <button id="pago-efectivo" class="w-full bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
                        Pagar al finalizar
                    </button>
                </div>

            </div>
        </div>

    </section>

</main>
<div id="modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4 flex justify-between items-center">
                        Resumen del pedido
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </h2>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <ul class="carrito-lista-pago"></ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between font-semibold">
                            <div>
                                <span>Total:(</span>
                                <span class="amountItems"></span>
                                <span>productos)</span>
                            </div>
                            <div>
                                <span>$</span>
                                <span class="total-h"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="checkout-form">
                    <div class="px-6 py-0">
                        <!-- Inputs Ocultos -->
                        <input type="hidden" id="statusPa" name="statusPa" value="1">
                        <input type="hidden" id="statusPe" name="statusPe" value="1">

                        <!-- Campo Nombre -->
                        <label for="nombreC" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ingresa tu nombre
                        </label>
                        <input type="text" id="nombreC" name="nombreC" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Botones -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 ">
                        <button id="confirmarPagoCash" type="button" onclick="handleSubmit()"
                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                            Ordenar
                        </button>
                        <button type="button" id="cancel-button"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Cancelar
                        </button>
                    </div>

                    <!-- Mensajes -->
                    <div id="error-message" style="color: red; display: none;"></div>
                    <div id="success-message" style="color: green; display: none;"></div>
                </form>

            </div>
        </div>
    </div>
</div>

<div id="modalCard" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white rounded-lg shadow-md w-full max-w-lg p-6">
                    <h2 class="text-2xl font-bold mb-6">Finalizar compra</h2>

                    <form>
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Información de pago</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="col-span-2">
                                        <label for="card-number" class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
                                        <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="expiry" class="block text-sm font-medium text-gray-700 mb-1">Fecha de expiración</label>
                                        <input type="text" id="expiry" name="expiry" placeholder="MM/AA" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label for="cvc" class="block text-sm font-medium text-gray-700 mb-1">CVC</label>
                                        <input type="text" id="cvc" name="cvc" placeholder="123" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-4 flex justify-between items-center">
                                    Resumen del pedido
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </h2>
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <ul class="carrito-lista-pago"></ul>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-4 mb-6">
                                    <div class="flex justify-between font-semibold">
                                        <div>
                                            <span>Total:(</span>
                                            <span class="amountItems"></span>
                                            <span>productos)</span>
                                        </div>
                                        <div>
                                            <span>$</span>
                                            <span class="total-h"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <form id="checkout-form">
                    <div class="px-6 py-0">
                        <!-- Inputs Ocultos -->
                        <input type="hidden" id="statusPa" name="statusPa" value="1">
                        <input type="hidden" id="statusPe" name="statusPe" value="1">

                        <!-- Campo Nombre -->
                        <label for="nombreC" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Ingresa tu nombre
                        </label>
                        <input type="text" id="nombreC" name="nombreC" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Botones -->
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 ">
                        <button id="confirmarPagoCard" type="button" onclick="handleSubmit2()"
                                class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                            Ordenar
                        </button>
                        <button type="button" id="cancel-button-2"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Cancelar
                        </button>
                    </div>
                    <!-- Mensajes -->
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    // Recupera el valor de nombreC desde sessionStorage
    let nombreCRecuperado = sessionStorage.getItem('nombreC');

    // Filtra los elementos de la lista de pedidos
    let pedidos = document.querySelectorAll('.pedido-item');

    pedidos.forEach(function(pedido) {
        // Verifica si el nombre del pedido coincide con el valor de sessionStorage
        if (pedido.getAttribute('data-nombre') !== nombreCRecuperado) {
            // Si no coincide, oculta el elemento
            pedido.style.display = 'none';
        }
    });





    const confirmarPagoCash = document.getElementById('confirmarPagoCash')
    const confirmarPagoCard = document.getElementById('confirmarPagoCash')

    const carritoContainer = document.getElementById('carrito-container')
    const botonesPago = document.getElementById('botones-pago')
    const modal = document.getElementById('modal');
    const cancelButton = document.getElementById('cancel-button');

    cancelButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    function openModal() {
        modal.classList.remove('hidden');
    }
    const modalCard = document.getElementById('modalCard');
    const cancelButton2 = document.getElementById('cancel-button-2');
    const pagoTarjeta = document.getElementById('pago-tarjeta')
    const pagos = document.getElementById('pagos')

    pagoTarjeta.addEventListener('click', () => {
        modalCard.classList.remove('hidden');
    });
    cancelButton2.addEventListener('click', () => {
        modalCard.classList.add('hidden');
    });
    let pagado = false

    const carritoIzquierdo = document.getElementById('carritoIzquierdo')
    const carritoDerecho = document.getElementById('carritoDerecho')
    let ordenActiva = sessionStorage.getItem('ordenActiva') === 'true';

    if(ordenActiva){
        procesoOrden()
    }

    function procesoOrden(){
        modal.classList.add('hidden')
        carritoIzquierdo.classList.add('hidden')
        botonesPago.classList.add('hidden')
        pagos.classList.remove('hidden')
    }
    confirmarPagoCash.addEventListener('click', procesoOrden)


    const cardPayment = document.getElementById('pago-tarjeta')
    const cashPayment = document.getElementById('pago-efectivo')
    cashPayment.addEventListener('click', openModal);

    /*
    cashPayment.addEventListener('click', ()){
    }
     */
    const amountItemsElements = document.querySelectorAll('.amount-items');
    const totalHElements = document.querySelectorAll('.total-h');

    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

    function guardarCarritoEnStorage() {
        sessionStorage.setItem('carrito', JSON.stringify(carrito));
    }


    // Declaración global de totalAmountCart
    let totalAmountCart = 0;

    function renderizarCarrito() {
        totalAmountCart = 0; // Reiniciar al renderizar el carrito

        const listaCarrito = document.querySelector('#carrito-lista');
        const listaCarritoPagoElements = document.querySelectorAll('.carrito-lista-pago');
        listaCarrito.innerHTML = ''; // Limpiar la lista antes de renderizar
        listaCarritoPagoElements.forEach(lista => lista.innerHTML = ''); // Limpiar todas las listas de pago

        // Agrupar productos por id y calcular cantidades
        const productosAgrupados = carrito.reduce((acc, producto) => {
            if (!acc[producto.id]) {
                acc[producto.id] = { ...producto, cantidad: 0 };
            }
            acc[producto.id].cantidad += 1;
            return acc;
        }, {});

        // Renderizar productos agrupados
        Object.values(productosAgrupados).forEach(producto => {
            const itemCarrito = document.createElement('li');
            const itemCarritoPago = document.createElement('li');
            let totalAmount = producto.cantidad * producto.precio;

            // Acumulamos el total de cada producto en totalAmountCart
            totalAmountCart += totalAmount;

            // Configuración del elemento para listaCarrito
            itemCarrito.classList.add('flex', 'shadow-md', 'mb-6');
            itemCarrito.innerHTML = `
        <div class="w-1/3 shrink-0 overflow-hidden rounded-md border border-gray-200 mr-4">
            <img src="public/${producto.imagen}" alt="${producto.descripcion}" class="w-full object-cover">
        </div>
        <div class="flex flex-col justify-around ml-3 w-1/2">
            <p class="font-bold text-2xl">${producto.descripcion}</p>
            <div class="flex justify-between">
                <span>$${totalAmount}</span>
                <div class="flex gap-6">
                    <button class="btn-disminuir" data-id="${producto.id}">-</button>
                    <span>${producto.cantidad}</span>
                    <button class="btn-aumentar" data-id="${producto.id}">+</button>
                </div>
            </div>
        </div>
    `;

            // Configuración del elemento para listaCarritoPago
            itemCarritoPago.innerHTML = `
        <div class="flex justify-between items-center">
            <span>${producto.descripcion} (x${producto.cantidad})</span>
        </div>
    `;
            itemCarritoPago.classList.add('flex', 'justify-between', 'py-2');

            // Agregar a las respectivas listas
            listaCarrito.appendChild(itemCarrito);
            listaCarritoPagoElements.forEach(lista => lista.appendChild(itemCarritoPago.cloneNode(true))); // Agregar a todas las listas de pago
        });

        // Actualizar totales y número de elementos
        document.querySelector('.amountItems').textContent = carrito.length; // Actualizar cantidad de productos
        document.querySelectorAll('.total-h').forEach(el => el.textContent = totalAmountCart.toFixed(2)); // Actualizar el total en todas las clases `total-h`

        // Añadir eventos a los botones
        const botonesAumentar = document.querySelectorAll('.btn-aumentar');
        const botonesDisminuir = document.querySelectorAll('.btn-disminuir');

        botonesAumentar.forEach(boton => {
            boton.addEventListener('click', () => {
                const id = boton.getAttribute('data-id');
                aumentarCantidad(id);
            });
        });

        botonesDisminuir.forEach(boton => {
            boton.addEventListener('click', () => {
                const id = boton.getAttribute('data-id');
                disminuirCantidad(id);
                checarCarro()
            });
        });
    }





    function aumentarCantidad(id) {
        const producto = carrito.find(p => p.id === id);
        if (producto) {
            carrito.push({ ...producto }); // Agregar otra unidad del producto
            guardarCarritoEnStorage(); // Guardar en sessionStorage
        }
        renderizarCarrito();

    }

    function disminuirCantidad(id) {
        const index = carrito.findIndex(p => p.id === id);
        if (index !== -1) {
            carrito.splice(index, 1); // Eliminar un producto del carrito
            guardarCarritoEnStorage(); // Guardar en sessionStorage
        }
        renderizarCarrito();
    }

    // Declaración global de totalAmountCart

    // Función para depurar el valor global

    renderizarCarrito();
    async function handleSubmit() {
        const nombreC = document.getElementById('nombreC').value;
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');

        // Validar campos
        if (!nombreC) {
            errorMessage.textContent = "El campo de nombre es obligatorio.";
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
            return;
        }

        // Guardar el nombre en sessionStorage

        sessionStorage.clear()
        renderizarCarrito();
        sessionStorage.setItem('nombreC', nombreC);
        ordenActiva = true;
        sessionStorage.setItem('ordenActiva', 'true');

        // Construir los datos para enviar
        const formData = new FormData();
        formData.append('nombreC', nombreC);
        formData.append('statusPa', 1);
        formData.append('statusPe', 1);
        formData.append('total', totalAmountCart);

        try {
            // Enviar datos con fetch
            const response = await fetch('/paloma-proyecto/carrito', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                console.log('Pedido realizado con éxito');

                // Limpiar formulario
                document.getElementById('checkout-form').reset();
            } else {
                throw new Error(result.message || 'Error desconocido');
            }
        } catch (error) {
            console.log(error)
        }
    }




    async function handleSubmit2() {
        const nombreC = document.getElementById('nombreC').value;
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');

        // Validar campos
        if (!nombreC) {
            errorMessage.textContent = "El campo de nombre es obligatorio.";
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
            return;
        }

        // Guardar el nombre en sessionStorage

        sessionStorage.clear()
        renderizarCarrito();
        sessionStorage.setItem('nombreC', nombreC);
        ordenActiva = true;
        sessionStorage.setItem('ordenActiva', 'true');
        sessionStorage.setItem('ordenActiva', 'true');

        // Construir los datos para enviar
        const formData = new FormData();
        formData.append('nombreC', nombreC);
        formData.append('statusPa', 2);
        formData.append('statusPe', 1);
        formData.append('total', totalAmountCart);

        try {
            // Enviar datos con fetch
            const response = await fetch('/paloma-proyecto/carrito', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                console.log('Pedido realizado con éxito');

                // Limpiar formulario
                document.getElementById('checkout-form').reset();
            } else {
                throw new Error(result.message || 'Error desconocido');
            }
        } catch (error) {
            console.log(error)
        }
    }

    const carroLleno = document.getElementById('carroLleno')
    const carroVacio = document.getElementById('carroVacío')

    function checarCarro() {
        // Obtener el carrito del sessionStorage y convertirlo en array
        const carrito = JSON.parse(sessionStorage.getItem('carrito') || '[]');

        // Verificar si el carrito tiene elementos
        if (carrito.length > 0 || ordenActiva === true) {
            carroLleno.classList.remove('hidden');
            carroVacio.classList.add('hidden');
        } else {
            carroLleno.classList.add('hidden');
            carroVacio.classList.remove('hidden');
        }
    }

    // Llamar a la función al cargar
    checarCarro();



</script>

</body>
</html>
