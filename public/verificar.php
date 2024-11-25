<?php
// Configuración
$plain_password = "cheli2024"; // Contraseña original
$encryption_key = "mySecretKey12345"; // Clave secreta
$cipher_method = "AES-256-CBC"; // Método de cifrado

// Cifrar la contraseña
$iv_length = openssl_cipher_iv_length($cipher_method);
$iv = openssl_random_pseudo_bytes($iv_length);
$encrypted_password = openssl_encrypt($plain_password, $cipher_method, $encryption_key, 0, $iv);
$encrypted_password_with_iv = base64_encode($iv . $encrypted_password);

echo "Contraseña cifrada: " . $encrypted_password_with_iv;
?>
