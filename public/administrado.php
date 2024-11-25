<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PalomaApp</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100">

  <!-- Contenedor principal -->
  <div class="flex flex-col h-screen">
    <!-- Encabezado -->
    <header class="bg-white shadow-lg p-6 border-b border-gray-200">
      <h1 class="text-3xl font-semibold text-gray-800">PalomaApp</h1>
    </header>

    <!-- Contenido debajo del encabezado -->
    <div class="flex flex-1">
      <!-- Barra lateral -->
      <aside class="w-1/4 bg-white shadow-md flex flex-col p-5 border-r border-gray-200">
        <nav class="mt-5">
          <ul>
            <li class="mb-5">
              <a href="#" class="text-lg font-medium text-gray-700 hover:underline">
                Dashboard
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

  <!-- Modal de pago -->
  <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white w-1/3 rounded-lg shadow-lg p-6 relative">
      <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">
        <i class="fas fa-times text-2xl"></i>
      </button>
      <div id="modalContent"></div>
    </div>
  </div>

  <script>
    let selectedOrderId = null;
    let selectedTotal = null;

    function openPaymentModal(orderId, total) {
      selectedOrderId = orderId;
      selectedTotal = total;
      document.getElementById('modalContent').innerHTML = `
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Método de Pago</h3>
        <p class="text-gray-600 mb-4">Total: $${total}</p>
        <div class="flex justify-around">
          <button onclick="showCashForm()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Efectivo</button>
          <button onclick="showCardForm()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Tarjeta</button>
        </div>
      `;
      document.getElementById('paymentModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('paymentModal').classList.add('hidden');
    }

    function showCashForm() {
      document.getElementById('modalContent').innerHTML = `
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pago en Efectivo</h3>
        <p class="text-gray-600 mb-4">Total: $${selectedTotal}</p>
        <label for="cashAmount" class="block text-gray-700 mb-2">Cantidad con la que paga:</label>
        <input id="cashAmount" type="number" class="w-full border rounded-lg p-2 mb-4" placeholder="Ingresa el monto">
        <button onclick="confirmCashPayment()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition w-full">Confirmar Pago</button>
        <button onclick="openPaymentModal(selectedOrderId, selectedTotal)" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition w-full mt-4">Regresar</button>
      `;
    }

    function showCardForm() {
      document.getElementById('modalContent').innerHTML = `
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pago con Tarjeta</h3>
        <p class="text-gray-600 mb-4">Total: $${selectedTotal}</p>
        <label for="cardNumber" class="block text-gray-700 mb-2">Número de Tarjeta:</label>
        <input id="cardNumber" type="text" class="w-full border rounded-lg p-2 mb-4" placeholder="Ingresa el número de tarjeta">
        <button onclick="confirmCardPayment()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition w-full">Confirmar Pago</button>
        <button onclick="openPaymentModal(selectedOrderId, selectedTotal)" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition w-full mt-4">Regresar</button>
      `;
    }

    function confirmCashPayment() {
      const cashAmount = parseFloat(document.getElementById('cashAmount').value);
      if (isNaN(cashAmount) || cashAmount < selectedTotal) {
        alert(`El monto ingresado no es suficiente. Faltan $${(selectedTotal - cashAmount).toFixed(2)}.`);
        return;
      }
      const change = cashAmount - selectedTotal;
      if (change > 0) {
        alert(`Pago confirmado. Tu cambio es: $${change.toFixed(2)}.`);
      }
      confirmPayment("efectivo");
    }

    function confirmCardPayment() {
      const cardNumber = document.getElementById('cardNumber').value.trim();
      if (!cardNumber || cardNumber.length < 16 || cardNumber.length > 19 || !/^\d+$/.test(cardNumber)) {
        alert("Por favor, ingresa un número de tarjeta válido.");
        return;
      }
      confirmPayment("tarjeta");
    }

    function confirmPayment(method) {
      fetch(`../controller/get_pedidos.php?action=pay&id=${selectedOrderId}&method=${method}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            updateCardStatus(selectedOrderId, method);
            closeModal();
          } else {
            console.error("Error:", data.error || "Error desconocido.");
          }
        })
        .catch(error => console.error("Error:", error));
    }

    function updateCardStatus(orderId, method) {
      const card = document.querySelector(`[data-id="${orderId}"]`);
      if (card) {
        card.querySelector('.payment-status').textContent = "Pagado";
        card.querySelector('.payment-status').classList.remove('text-red-500');
        card.querySelector('.payment-status').classList.add('text-green-500');
        const paymentButton = card.querySelector('.payment-button');
        if (paymentButton) {
          paymentButton.remove();
        }
      }
    }
  </script>
</body>
</html>
