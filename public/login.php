<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Left Pane -->
    <div class="hidden lg:flex flex-1 items-center justify-center bg-white">
      <div class="max-w-md text-center">
        <img src="logoCheli.webp" alt="Illustration" class="w-full h-auto mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Bienvenido trabajador</h1>
        <p class="mt-4 text-gray-600">Si todos avanzamos juntos, el éxito llegará solo.</p>
      </div>
    </div>

    <!-- Right Pane -->
    <div class="flex-1 flex items-center justify-center bg-gray-200">
      <div id="form-container" class="w-full max-w-md px-6 py-8 bg-white shadow-md rounded-md transition-transform duration-500">
        <!-- Email Form -->
        <div id="email-form">
          <h2 class="text-xl font-bold text-gray-800 text-center">Login</h2>
          <form id="email-form-content" class="mt-6">
            <div class="mb-4">
              <label for="email" class="block text-gray-600 font-medium">Email</label>
              <input type="email" id="email" name="correo" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none">
            </div>
            <button type="button" id="btn-email" class="w-full mt-4 py-2 bg-blue-500 text-white font-bold rounded-md hover:bg-blue-600">Ingresa</button>
          </form>
        </div>

        <!-- Password Form -->
        <div id="password-form" class="hidden">
          <h2 class="text-xl font-bold text-gray-800 text-center">Verifica tu contraseña</h2>
          <form id="password-form-content" class="mt-6">
            <div class="mb-4">
              <label for="password" class="block text-gray-600 font-medium">Contraseña</label>
              <input type="password" id="password" name="password" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none">
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
      <p id="modal-message" class="text-gray-800"></p>
      <button id="close-modal" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Cerrar</button>
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

      // Manejo del modal
      function showModal(message) {
        modalMessage.textContent = message;
        modal.classList.remove('hidden');
      }
      closeModal.addEventListener('click', () => modal.classList.add('hidden'));

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

      // Verificar contraseña
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
            showModal("Inicio de sesión exitoso.");
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
