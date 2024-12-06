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
        <button onclick="logOut()" class="hidden lg:flex ">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 20H6C4.89543 20 4 19.1046 4 18L4 6C4 4.89543 4.89543 4 6 4H14M10 12H21M21 12L18 15M21 12L18 9" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </button>
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
                </div>

            </div>
        </div>

    </section>

</main>
<div id="modalCard" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white rounded-lg shadow-md w-full max-w-lg p-6">
                    <h2 class="text-2xl font-bold mb-6">Finalizar compra</h2>
                    <div id="alert-message" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 hidden" role="alert">
                        <p id="message"></p>
                    </div>
                    <form id="form-pago">
                        <div class="space-y-6">
                            <div class="col-span-2">
                                <label for="card-number" class="block text-sm font-medium text-gray-700 mb-1">Número de tarjeta</label>
                                <input
                                        type="text"
                                        id="card-number"
                                        name="card-number"
                                        placeholder="1234 5678 9012 3456"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required
                                        pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13}|6(?:011|5[0-9]{2})[0-9]{12})$"
                                        title="Introduce un número de tarjeta válido (Visa, Mastercard, American Express, Discover).">
                            </div>

                            <!-- Validación para la fecha de expiración -->
                            <div>
                                <label for="expiry" class="block text-sm font-medium text-gray-700 mb-1">Fecha de expiración</label>
                                <input
                                        type="text"
                                        id="expiry"
                                        name="expiry"
                                        placeholder="MM/AA"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required
                                        pattern="^(0[1-9]|1[0-2])\/\d{2}$"
                                        title="Introduce una fecha de expiración válida en formato MM/AA.">
                            </div>

                            <!-- Validación para el CVC -->
                            <div>
                                <label for="cvc" class="block text-sm font-medium text-gray-700 mb-1">CVC</label>
                                <input
                                        type="text"
                                        id="cvc"
                                        name="cvc"
                                        placeholder="123"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        required
                                        pattern="^\d{3,4}$"
                                        title="El código de seguridad debe tener 3 o 4 dígitos.">
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
                </form>
            </div>
        </div>
    </div>
</div>
<div id="popUpPago" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <!-- Pop-up -->
    <div class="bg-white rounded-lg shadow-xl p-6 w-80 max-w-md mx-auto">
        <div class="text-center">
            <!-- Icono de check (puedes reemplazarlo con una imagen si lo prefieres) -->
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>

            <h2 class="mt-4 text-xl font-bold text-gray-900">Pago Aceptado</h2>
            <p class="mt-2 text-sm text-gray-500">Tu pago ha sido procesado con éxito.</p>
        </div>

        <!-- Botón para cerrar -->
        <div class="mt-6">
            <button onclick="closePopup()" class="w-full bg-green-500 text-white rounded-md px-4 py-2 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition-colors duration-300">
                Cerrar
            </button>
        </div>
    </div>
</div>
<script>

    const confirmarPagoCard = document.getElementById('confirmarPagoCash')

    const carritoContainer = document.getElementById('carrito-container')
    const botonesPago = document.getElementById('botones-pago')
    const modal = document.getElementById('modal');
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
    function closePopup() {
        const popUp = document.getElementById('popUpPago');
        popUp.classList.add('hidden')
        checarCarro()
    }

    const cardPayment = document.getElementById('pago-tarjeta')




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
            itemCarrito.classList.add('flex', 'shadow-md', 'mb-6','border', 'rounded-md');
            itemCarrito.innerHTML = `
        <div class="w-1/3 shrink-0 overflow-hidden rounded-md border border-gray-200 mr-4">
            <img src="public/imagenes/${producto.imagen}" alt="${producto.descripcion}" class="w-full object-cover" style="height: 200px">
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



    const popUpPago = document.getElementById('popUpPago')
    const message = document.getElementById('message')
    const alertMessage = document.getElementById('alert-message')
    async function handleSubmit2() {
        // Validar campos de tarjeta
        const cardNumber = document.getElementById("card-number").value;
        const expiry = document.getElementById("expiry").value;
        const cvc = document.getElementById("cvc").value;

        // Patrón para validar los campos
        const cardPattern = /^\d{16}$/;
        const expiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
        const cvcPattern = /^\d{3,4}$/;

        if (!cardPattern.test(cardNumber)) {
            alertMessage.classList.remove('hidden')
            message.textContent = "Por favor, introduce un número de tarjeta válido.";
            return;
        }

        if (!expiryPattern.test(expiry)) {
            alertMessage.classList.remove('hidden')
            message.textContent = "Por favor, introduce una fecha de expiración válida en formato MM/AA."
            return;
        }

        if (!cvcPattern.test(cvc)) {
            alertMessage.classList.remove('hidden')
            message.textContent = "Por favor, introduce un CVC válido (3 o 4 dígitos)."
            return;
        }

        // Renderizar carrito
        renderizarCarrito();

        // Obtener los productos del sessionStorage
        const productos = JSON.parse(sessionStorage.getItem('carrito'));

        // Crear un objeto para contar la cantidad de cada producto
        const productosContados = {};

        productos.forEach(producto => {
            if (productosContados[producto.id]) {
                productosContados[producto.id].cantidad++;
            } else {
                productosContados[producto.id] = {
                    idPr: producto.id,
                    descripcion: producto.descripcion,
                    precio: parseFloat(producto.precio),
                    cantidad: 1
                };
            }
        });

        // Crear un array con los detalles del pedido (idP, idPr, cantidad, subtotal)
        const detallesPedido = Object.values(productosContados).map(producto => {
            return {
                idPr: producto.idPr,
                cantidad: producto.cantidad,
                subtotal: producto.cantidad * producto.precio
            };
        });

        // Construir los datos para enviar
        const formData = new FormData();
        formData.append('nombreC', sessionStorage.getItem('nombre'));
        formData.append('statusPa', 2);
        formData.append('statusPe', 1);
        formData.append('total', totalAmountCart);
        formData.append('idU', sessionStorage.getItem('idU'));

        // Añadir los detalles del pedido
        detallesPedido.forEach((detalle, index) => {
            formData.append(`detalle[${index}][idPr]`, detalle.idPr);
            formData.append(`detalle[${index}][cantidad]`, detalle.cantidad);
            formData.append(`detalle[${index}][subtotal]`, detalle.subtotal);
        });

        console.log("Datos que se están enviando:");
        formData.forEach((value, key) => {
            console.log(`${key}: ${value}`);
        });

        try {
            const response = await fetch('/paloma-proyecto/carrito', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                alertMessage.classList.add('hidden')
                popUpPago.classList.add('flex');
                popUpPago.classList.remove('hidden');
                modalCard.classList.add('hidden');
                document.getElementById('checkout-form').reset();
                document.getElementById('form-pago').reset();
                sessionStorage.removeItem('carrito');
            } else {
                throw new Error(result.message || 'Error desconocido');
            }
        } catch (error) {
            console.log(error);
        }
    }



    const carroLleno = document.getElementById('carroLleno')
    const carroVacio = document.getElementById('carroVacío')

    function checarCarro() {
        // Obtener el carrito del sessionStorage y convertirlo en array
        const carrito = JSON.parse(sessionStorage.getItem('carrito') || '[]');

        // Verificar si el carrito tiene elementos
        if (carrito.length > 0) {
            carroLleno.classList.remove('hidden');
            carroVacio.classList.add('hidden');
        } else {
            carroLleno.classList.add('hidden');
            carroVacio.classList.remove('hidden');
        }
    }

    // Llamar a la función al cargar
    checarCarro();


    function logOut() {

        window.location.href = "public/login.php";
        sessionStorage.clear()
    }
</script>

</body>
</html>
