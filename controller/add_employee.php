<?php
include 'conexion.php';

// Configuración de cifrado
$encryption_key = "mySecretKey12345"; // Clave secreta
$cipher_method = "AES-256-CBC";

function encrypt_password($plain_password, $encryption_key, $cipher_method) {
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted_password = openssl_encrypt($plain_password, $cipher_method, $encryption_key, 0, $iv);
    return base64_encode($iv . $encrypted_password);
}

// Manejo de datos POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (!$name || !$email || !$password || !$role) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    $encrypted_password = encrypt_password($password, $encryption_key, $cipher_method);

    $sql = "INSERT INTO usuario (nombre, correo, contraseña, rol) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $encrypted_password, $role);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al agregar el empleado."]);
    }

    $stmt->close();
    $conexion->close();
}
?>
