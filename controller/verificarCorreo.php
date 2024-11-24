<?php
include 'conexion.php';

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    if ($action === "verificarCorreo") {
        if (empty($_POST["correo"])) {
            echo json_encode(["status" => "error", "message" => "Por favor ingresa tu correo."]);
        } else {
            $correo = $_POST["correo"];
            $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
            $result = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo json_encode(["status" => "success", "message" => "Correo válido."]);
            } else {
                echo json_encode(["status" => "error", "message" => "El correo no está registrado."]);
            }
        }
    } elseif ($action === "verificarPassword") {
        if (empty($_POST["password"])) {
            echo json_encode(["status" => "error", "message" => "Por favor ingresa tu contraseña."]);
        } else {
            $correo = $_POST["correo"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM usuario WHERE correo = '$correo' AND contraseña = '$password'";
            $result = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo json_encode(["status" => "success", "message" => "Inicio de sesión exitoso."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Contraseña incorrecta."]);
            }
        }
    }
}
?>
