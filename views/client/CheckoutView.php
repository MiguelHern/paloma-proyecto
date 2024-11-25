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
            <a href="#" class="text-sm/6 font-semibold text-gray-900">Log in <span aria-hidden="true">&rarr;</span></a>
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

<main class="flex gap-6">
    <section class="w-2/3">
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
                        <ul id="carrito-lista-pago"></ul>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <div class="flex justify-between font-semibold">
                        <div >
                            <span>Total:(</span>
                            <span id="amountItems"></span>
                            <span>productos)</span>
                        </div>
                        <div>
                            <span>$</span>
                            <span id="total-h"></span>
                        </div>

                    </div>
                </div>
                <div class="flex gap-4">
                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
                        Pagar con tarjeta
                    </button><button class="w-full bg-gray-400 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors">
                        Pagar al finalizar
                    </button>
                </div>

            </div>
        </div>

    </section>
</main>

<script>
    const totalHt = document.getElementById('total-h')
    const amountItems = document.getElementById('amountItems')

    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

    function guardarCarritoEnStorage() {
        sessionStorage.setItem('carrito', JSON.stringify(carrito));
    }


    function renderizarCarrito() {
        let totalAmountCart = 0;


        const listaCarrito = document.querySelector('#carrito-lista');
        const listaCarritoPago = document.querySelector('#carrito-lista-pago');
        listaCarrito.innerHTML = ''; // Limpiar la lista antes de renderizar

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
            const itemCarritoPago = document.createElement('li')
            let totalAmount = producto.cantidad * producto.precio;

            // Acumulamos el total de cada producto en totalAmountCart
            totalAmountCart += totalAmount;

            itemCarrito.classList.add('flex', 'shadow-md', 'mb-6');
            itemCarrito.innerHTML = `
            <div class="w-1/3 shrink-0 overflow-hidden rounded-md border border-gray-200 mr-4">
                <img src="public/${producto.imagen}" alt="${producto.descripcion}" class="w-full object-cover">
            </div>
            <div class="flex flex-col justify-between ml-3 w-1/2">
                <p class="font-bold text-2xl">${producto.descripcion}</p>
                <div class="flex justify-between">
                    <span>$${totalAmount}</span>
                    <button class="btn-disminuir" data-id="${producto.id}">-</button>
                    <span>${producto.cantidad}</span>
                    <button class="btn-aumentar" data-id="${producto.id}">+</button>
                </div>
            </div>
        `;
            itemCarritoPago.classList.add('flex', 'justify-between', 'py-2');
            itemCarritoPago.innerHTML = `
            <span>${producto.descripcion} (${producto.cantidad})</span>
        `;

            // Agregar a las respectivas listas
            listaCarrito.appendChild(itemCarrito);
            listaCarritoPago.appendChild(itemCarritoPago);
        });

        // Mostrar el total del carrito fuera de la función (puedes usarlo en otro lugar)


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
            });
        });

        amountItems.textContent = carrito.length
        totalHt.textContent = totalAmountCart
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


    // Llamar a la función para renderizar inicialmente
    renderizarCarrito();
</script>

</body>
</html>
