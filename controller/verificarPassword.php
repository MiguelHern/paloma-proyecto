<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de entrada: evitar inyecciones SQL
    if (empty($_POST['correo']) || empty($_POST['contraseña'])) {
        echo "Por favor ingresa ambos campos.";
    } else {
        $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
        $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);

        // Consulta SQL para verificar si el correo y la contraseña coinciden
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contraseña = '$contraseña'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            echo "Ingreso exitoso.";
        } else {
            echo "Contraseña incorrecta.";
        }
    }
}
?>
