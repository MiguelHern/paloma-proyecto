<?php
include 'conexion.php';

// Configuración de cifrado
$encryption_key = "mySecretKey12345"; // Clave secreta
$cipher_method = "AES-256-CBC"; // Método de cifrado

/**
 * Cifra una contraseña usando OpenSSL.
 */
function encrypt_password($plain_password, $encryption_key, $cipher_method) {
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted_password = openssl_encrypt($plain_password, $cipher_method, $encryption_key, 0, $iv);
    return base64_encode($iv . $encrypted_password);
}

/**
 * Descifra una contraseña usando OpenSSL.
 */
function decrypt_password($encrypted_password_with_iv, $encryption_key, $cipher_method) {
    $encrypted_password_with_iv = base64_decode($encrypted_password_with_iv);
    $iv_length = openssl_cipher_iv_length($cipher_method);
    $iv = substr($encrypted_password_with_iv, 0, $iv_length);
    $encrypted_password = substr($encrypted_password_with_iv, $iv_length);
    return openssl_decrypt($encrypted_password, $cipher_method, $encryption_key, 0, $iv);
}

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action === "verificarCorreo") {
        if (empty($_POST["correo"])) {
            echo json_encode(["status" => "error", "message" => "Por favor ingresa tu correo."]);
        } else {
            $correo = $_POST["correo"];
            $sql = "SELECT * FROM usuario WHERE correo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo json_encode(["status" => "success", "message" => "Correo válido."]);
            } else {
                echo json_encode(["status" => "error", "message" => "El correo no está registrado."]);
            }
            $stmt->close();
        }
    } elseif ($action === "verificarPassword") {
        if (empty($_POST["password"])) {
            echo json_encode(["status" => "error", "message" => "Por favor ingresa tu contraseña."]);
        } else {
            $correo = $_POST["correo"];
            $password = $_POST["password"];
            $sql = "SELECT contraseña, nombre, rol FROM usuario WHERE correo = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stored_encrypted_password = $row["contraseña"];
                $nombre = $row["nombre"];
                $rol = $row["rol"];

                // Descifrar y comparar contraseñas
                $decrypted_password = decrypt_password($stored_encrypted_password, $encryption_key, $cipher_method);

                if ($password === $decrypted_password) {
                    // Redirigir según el rol
                    if ($rol == 1) {
                        echo json_encode([
                            "status" => "success",
                            "redirect" => "administrado.php",
                            "correo" => $correo,
                            "nombre" => $nombre
                        ]);
                    } elseif ($rol == 2) {
                        echo json_encode([
                            "status" => "success",
                            "redirect" => "cocinero.php",
                            "correo" => $correo,
                            "nombre" => $nombre
                        ]);
                    } elseif ($rol == 3) {
                        echo json_encode([
                            "status" => "success",
                            "redirect" => "../",
                            "correo" => $correo,
                            "nombre" => $nombre
                        ]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Rol no válido."]);
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Contraseña incorrecta."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Correo no encontrado."]);
            }
            $stmt->close();
        }
    }
}
?>
