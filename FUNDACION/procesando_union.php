<?php
// Incluir el archivo de conexión
include 'Conexion.php';

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener y sanitizar los datos enviados por el formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo = htmlspecialchars(trim($_POST['correo']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($correo)) {
        echo "<h3>Error: El nombre y el correo electrónico son obligatorios.</h3>";
        exit;
    }

    // Conectar a la base de datos
    $db = new Conecta();
    $conexion = $db->conectarDB();

    // Preparar la consulta para insertar los datos en la base de datos
    $stmt = $conexion->prepare("INSERT INTO Unete (nombre, correo, telefono, mensaje) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . $conexion->error;
        exit;
    }

    // Asociar los parámetros y ejecutar la consulta
    $stmt->bind_param("ssss", $nombre, $correo, $telefono, $mensaje);
    if ($stmt->execute()) {
        echo "<h2>Formulario Procesado y Datos Guardados en la Base de Datos</h2>";
        echo "<p><strong>Nombre Completo:</strong> $nombre</p>";
        echo "<p><strong>Correo Electrónico:</strong> $correo</p>";
        echo "<p><strong>Teléfono:</strong> " . (!empty($telefono) ? $telefono : "No proporcionado") . "</p>";
        echo "<p><strong>Mensaje:</strong> " . (!empty($mensaje) ? $mensaje : "No proporcionado") . "</p>";
    } else {
        echo "<h3>Error al guardar los datos: " . $stmt->error . "</h3>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $db->cerrar();
} else {
    // Si el formulario no fue enviado correctamente
    echo "<h3>Error: No se enviaron datos válidos.</h3>";
}
?>
