<?php
require_once 'conexion.php'; // Incluir la clase de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar entradas
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Verificar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, completa todos los campos correctamente.";
    } else {
        // Instanciar la conexión a la base de datos
        $conecta = new Conecta();
        $conexion = $conecta->conectarDB();

        // Preparar la consulta SQL para verificar el usuario y la contraseña
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Enlazar los parámetros y ejecutar la consulta
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si el usuario existe
            if ($result->num_rows > 0) {
                $usuario = $result->fetch_assoc();
                // Verificar la contraseña
                if (password_verify($password, $usuario['password'])) {
                    echo "<h1>Bienvenido, $username!</h1>";
                    // Aquí podrías redirigir a una página de inicio o dashboard
                } else {
                    echo "Contraseña incorrecta.";
                }
            } else {
                echo "Usuario no encontrado.";
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conexion->error;
        }

        // Cerrar la conexión
        $conecta->cerrar();
    }
} else {
    // Redirigir si el acceso no es a través de POST
    header("Location: login.html");
    exit();
}
?>
