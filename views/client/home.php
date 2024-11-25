<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="public/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
<header>
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
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Tienda</a>
                            <a href="/shopping-bag" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Carrito</a>
                        </div>
                        <div class="py-6">
                            <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    </header>
<main class="">
    <section class="favorite-movies mt-3">
        <?php foreach ($productosAgrupados as $nombre => $productosCategoria): ?>
        <header >
            <h2 class="ml-4 text-2xl font-semibold"><?php echo htmlspecialchars($nombre); ?></h2>
        </header>
        <div class="relative overflow-hidden">
            <ul class="flex gap-2 transition-transform duration-500 ease-in-out" id="carousel-favorites">
                <?php foreach ($productosCategoria as $producto): ?>
                    <li data-id="<?php echo $producto['idPr']; ?>"
                        data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>"
                        data-precio="<?php echo number_format($producto['precioU'], 2); ?>"
                        data-imagen="<?php echo htmlspecialchars($producto['imagen']); ?>"
                        class="relative w-1/4 flex-shrink-0 h-full p-4 rounded-lg group">
                        <img src="public/<?php echo htmlspecialchars($producto['imagen']); ?>"
                             alt="<?php echo htmlspecialchars($producto['descripcion']); ?>"
                             class="w-full h-full mt-4 rounded-lg">
                        <h3 class="text-lg font-bold"><?php echo htmlspecialchars($producto['descripcion']); ?></h3>
                        <p class="text-sm text-gray-400">$<?php echo number_format($producto['precioU'], 2); ?></p>
                        <!-- Hover Text -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
                            Agregar al carrito
                        </div>
                    </li>

                <?php endforeach; ?>

            </ul>

            <button class="absolute left-0 top-1/2 transform -translate-y-1/2 text-white" id="prev"><svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M13.26 15.53L9.73999 12L13.26 8.46997" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
            <button class="absolute right-0 top-1/2 transform -translate-y-1/2 text-white" id="next"><svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M10.74 15.53L14.26 12L10.74 8.46997" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg></button>
        </div>
        <?php endforeach; ?>
    </section>

</main>

<script>
    let currentIndex = 0;
    const itemsToShow = 4;  // Cuántos elementos mostrar a la vez
    const carousel = document.getElementById("carousel-favorites");
    const totalItems = carousel.children.length;

    document.getElementById("next").addEventListener("click", () => {
        if (currentIndex < totalItems - itemsToShow) {
            currentIndex++;
            carousel.style.transform = `translateX(-${(100 / itemsToShow) * currentIndex}%)`;
        }
    });

    document.getElementById("prev").addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            carousel.style.transform = `translateX(-${(100 / itemsToShow) * currentIndex}%)`;
        }
    });

    // Cambiar el selector para que apunte a los elementos <li> con el atributo data-id
    const productos = document.querySelectorAll('li[data-id]');
    // Cargar el carrito desde el localStorage si existe
    // Cargar el carrito desde sessionStorage si existe
    let carrito = JSON.parse(sessionStorage.getItem('carrito')) || [];

    // Agregar el evento de clic a cada elemento
    productos.forEach(producto => {
        producto.addEventListener('click', () => {
            // Obtener los datos completos del producto desde los atributos data-*
            const idProducto = producto.getAttribute('data-id');
            const descripcion = producto.getAttribute('data-descripcion');
            const precio = producto.getAttribute('data-precio');
            const imagen = producto.getAttribute('data-imagen');

            // Crear un objeto con la información del producto
            const productoObjeto = {
                id: idProducto,
                descripcion: descripcion,
                precio: precio,
                imagen: imagen
            };

            // Agregar el objeto al carrito
            carrito.push(productoObjeto);

            // Guardar el carrito actualizado en sessionStorage
            sessionStorage.setItem('carrito', JSON.stringify(carrito));
        });
    });



</script>
</body>
</html>