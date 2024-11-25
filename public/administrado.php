<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PalomaApp - Administrador</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">

  <!-- Contenedor principal -->
  <div class="flex flex-col h-screen">
    <!-- Encabezado -->
    <header class="bg-white shadow-lg p-6 border-b border-gray-200">
      <h1 class="text-3xl font-semibold text-gray-800">PalomaApp - Administrador</h1>
    </header>

    <!-- Contenido debajo del encabezado -->
    <div class="flex flex-1">
      <!-- Barra lateral -->
      <aside class="w-1/4 bg-white shadow-md flex flex-col p-5 border-r border-gray-200">
        <nav class="mt-5">
          <ul>
            <li class="mb-5">
              <a href="#" id="dashboard" class="text-lg font-medium text-gray-700 hover:underline">
                Dashboard
              </a>
            </li>
            <li class="mb-5">
              <a href="#" id="addEmployee" class="text-lg font-medium text-gray-700 hover:underline">
                Agregar empleados
              </a>
            </li>
          </ul>
        </nav>
      </aside>

      <!-- Contenido principal -->
      <main class="flex-1 p-6 overflow-y-auto bg-gray-50">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="cardsContainer">
          <?php include '../controller/get_pedidos.php'; ?>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Manejador para mostrar las cards al hacer clic en "Dashboard"
    document.getElementById('dashboard').addEventListener('click', (e) => {
      e.preventDefault();
      const container = document.getElementById('cardsContainer');

      // Mostrar las cards originales cargando el archivo PHP
      fetch('../controller/get_pedidos.php')
        .then(response => response.text())
        .then(data => {
          container.innerHTML = data;
        })
        .catch(error => console.error("Error cargando las cards:", error));
    });

    // Manejador para mostrar el formulario al hacer clic en "Agregar empleados"
    document.getElementById('addEmployee').addEventListener('click', (e) => {
      e.preventDefault();
      const container = document.getElementById('cardsContainer');
      container.innerHTML = `
        <div class="w-full bg-white p-6 rounded-lg shadow-lg">
          <h2 class="text-2xl font-semibold text-gray-800 mb-6">Agregar Nuevo Empleado</h2>
          <form id="addEmployeeForm" class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
              <input id="name" name="name" type="text" required class="w-full mt-1 p-2 border rounded">
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
              <input id="email" name="email" type="email" required class="w-full mt-1 p-2 border rounded">
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
              <div class="relative">
                <input id="password" name="password" type="password" required class="w-full mt-1 p-2 border rounded pr-10">
                <span id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-600">
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
            <div>
              <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
              <select id="role" name="role" required class="w-full mt-1 p-2 border rounded">
                <option value="1">Administrador</option>
                <option value="2">Cocinero</option>
              </select>
            </div>
            <button type="button" id="saveEmployee" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Guardar Empleado</button>
          </form>
        </div>
      `;

      // Manejador para alternar visibilidad de la contraseña
      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.getElementById('password');
      togglePassword.addEventListener('click', () => {
        const isPasswordVisible = passwordField.type === 'text';
        passwordField.type = isPasswordVisible ? 'password' : 'text';
        togglePassword.innerHTML = `<i class="fas ${isPasswordVisible ? 'fa-eye' : 'fa-eye-slash'}"></i>`;
      });

      // Manejo del envío del formulario
      document.getElementById('saveEmployee').addEventListener('click', () => {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        fetch('../controller/add_employee.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `name=${name}&email=${email}&password=${password}&role=${role}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === "success") {
            alert("Empleado agregado correctamente.");
            document.getElementById('dashboard').click(); // Regresa a las cards automáticamente
          } else {
            alert("Error: " + data.message);
          }
        })
        .catch(error => console.error("Error:", error));
      });
    });
  </script>
</body>
</html>
