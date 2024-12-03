<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Left Pane -->

    <!-- Right Pane -->
    <div class="flex-1 flex items-center justify-center bg-gray-200">
      <div id="form-container" class="w-full max-w-md px-6 py-8 bg-white shadow-md rounded-md transition-transform duration-500">
        <!-- Email Form -->
        <div id="email-form">
          <h2 class="text-xl font-bold text-gray-800 text-center">Iniciar sesión</h2>
          <form id="email-form-content" class="mt-6">
            <div class="mb-4">
              <label for="email" class="block text-gray-600 font-medium">Correo</label>
              <input type="email" id="email" name="correo" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
              <p class="text-sm font-light text-gray-500">
                  Olvidaste tu contraseña? <a href="RecoverPassword.php" class="font-medium text-primary-600 hover:underline">Recuperala aquí</a>
              </p>
            <button type="button" id="btn-email" class="w-full mt-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">Ingresa</button>
              <div class="flex justify-center">
              <a href="SignUp.php" type="button" id="btn-email" class="block text-center w-2/3 mt-4 py-2 bg-green-600 text-white font-bold rounded-md hover:bg-green-500">Registrate</a>
              </div>
          </form>
        </div>

        <!-- Password Form -->
        <div id="password-form" class="hidden">
          <h2 class="text-xl font-bold text-gray-800 text-center">Verifica tu contraseña</h2>
          <form id="password-form-content" class="mt-6">
            <div class="mb-4 relative">
              <label for="password" class="block text-gray-600 font-medium">Contraseña</label>
              <div class="relative">
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md pr-10 focus:ring focus:ring-blue-200 focus:outline-none"
                >
                <span
                  id="togglePassword"
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer text-gray-600"
                >
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
            <button type="button" id="btn-password" class="w-full mt-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">Verificar</button>
            <button type="button" id="btn-back-to-email" class="w-full mt-4 py-2 bg-gray-500 text-white font-bold rounded-md hover:bg-gray-600">Regresar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <p id="modal-message" class="text-gray-800 font-semibold"></p>
        <div class="flex justify-center">
            <button id="close-modal" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar</button>
        </div>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const emailForm = document.getElementById('email-form');
      const passwordForm = document.getElementById('password-form');
      const btnEmail = document.getElementById('btn-email');
      const btnPassword = document.getElementById('btn-password');
      const btnBackToEmail = document.getElementById('btn-back-to-email');
      const modal = document.getElementById('modal');
      const modalMessage = document.getElementById('modal-message');
      const closeModal = document.getElementById('close-modal');
      const togglePassword = document.getElementById('togglePassword');
      const passwordField = document.getElementById('password');

      // Manejo del modal
      function showModal(message) {
        modalMessage.textContent = message;
        modal.classList.remove('hidden');
      }
      closeModal.addEventListener('click', () => modal.classList.add('hidden'));

      // Mostrar/Ocultar contraseña
      togglePassword.addEventListener('click', () => {
        const isPasswordVisible = passwordField.type === 'text';
        passwordField.type = isPasswordVisible ? 'password' : 'text';
        togglePassword.innerHTML = `<i class="fas ${isPasswordVisible ? 'fa-eye' : 'fa-eye-slash'}"></i>`;
      });

      // Verificar correo
      btnEmail.addEventListener('click', () => {
        const correo = document.getElementById('email').value;

        fetch('../controller/verificarCorreo.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `action=verificarCorreo&correo=${correo}`
        })
        .then(response => response.json())
        .then(data => {
          if (data.status === "success") {
            emailForm.classList.add('hidden');
            passwordForm.classList.remove('hidden');
          } else {
            showModal(data.message);
          }
        })
        .catch(err => console.error(err));
      });

      // Verificar contraseña y redirigir según el rol
        btnPassword.addEventListener('click', () => {
            const correo = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('../controller/verificarCorreo.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=verificarPassword&correo=${correo}&password=${password}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        // Guardar correo y nombre en sessionStorage
                        sessionStorage.setItem('email', data.correo);
                        sessionStorage.setItem('nombre', data.nombre);

                        // Redirigir según el rol
                        window.location.href = data.redirect;
                    } else {
                        showModal(data.message);
                    }
                })
                .catch(err => console.error(err));
        });



        // Manejo del botón "Regresar"
      btnBackToEmail.addEventListener('click', () => {
        passwordForm.classList.add('hidden');
        emailForm.classList.remove('hidden');
      });
    });
  </script>
</body>
</html>
