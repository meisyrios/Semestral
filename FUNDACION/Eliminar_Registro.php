<?php
// Incluir el archivo de la clase Conecta
include 'conexion.php';

// Crear una instancia de la clase Conecta y conectar a la base de datos
$con = new Conecta();
$conn = $con->conectarDB();

// Capturar el valor de la cédula desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];

    // Preparar y ejecutar la consulta para eliminar
    $sql = "DELETE FROM usuarios WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cedula);

    if ($stmt->execute()) {
        echo "<p style='text-align: center; color: green;'>Registro eliminado correctamente.</p>";
    } else {
        echo "<p style='text-align: center; color: red;'>Error al eliminar el registro: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Cerrar la conexión
$con->cerrar();
?>
