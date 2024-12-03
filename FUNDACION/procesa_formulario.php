<?php
require_once 'conexion.php'; // Incluir la clase de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar entradas
    $nombre = htmlspecialchars(trim($_POST['name']));
    $correo = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['celular']));
    $comentario = htmlspecialchars(trim($_POST['comentario']));

    // Verificar que los campos no estén vacíos
    if (empty($nombre) || !$correo || empty($telefono) || empty($comentario)) {
        echo "Por favor, completa todos los campos correctamente.";
    } else {
        // Instanciar la conexión a la base de datos
        $conecta = new Conecta();
        $conexion = $conecta->conectarDB();

        // Preparar la consulta SQL
        $sql = "INSERT INTO Contactanos (nombre, correo, telefono, comentario) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            // Enlazar los parámetros y ejecutar la consulta
            $stmt->bind_param("ssss", $nombre, $correo, $telefono, $comentario);
            if ($stmt->execute()) {
                echo "<h1>¡Gracias por contactarnos!</h1>";
                echo "<p>Nombre: $nombre</p>";
                echo "<p>Correo: $correo</p>";
                echo "<p>Teléfono: $telefono</p>";
                echo "<p>Comentario: $comentario</p>";
            } else {
                echo "Error al guardar los datos: " . $conexion->error;
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
    header("Location: CONTACTANOS.html");
    exit();
}
?>
