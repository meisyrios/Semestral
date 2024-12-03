<?php
include 'conexion.php';

// Crear el objeto de conexión
$conexion = new Conecta();
$cnn = $conexion->conectarDB();

// Verificar si la cédula y los otros parámetros están presentes
$cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : '';
$campo = isset($_POST["campo"]) ? trim($_POST["campo"]) : '';
$valor = isset($_POST["nuevo_valor"]) ? trim($_POST["nuevo_valor"]) : '';

if (!empty($cedula) && !empty($campo) && !empty($valor)) {
    // Verificar que el campo es válido
    $campos_validos = ['nombre', 'apellido', 'celular', 'carrera', 'correo'];
    if (in_array($campo, $campos_validos)) {
        // Preparar la declaración SQL para actualizar el campo
        $sql = "UPDATE usuarios SET $campo = ? WHERE cedula = ?";
        $stmt = $cnn->prepare($sql);
        
        // Verificar que la declaración se preparó correctamente
        if ($stmt) {
            // Vincular los parámetros
            $stmt->bind_param("ss", $valor, $cedula);
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "El registro ha sido actualizado correctamente.";
            } else {
                echo "Error al actualizar el registro: " . $stmt->error;
            }
        } else {
            echo "Error al preparar la consulta.";
        }
    } else {
        echo "Campo no válido para actualizar.";
    }
} else {
    echo "Por favor, complete todos los campos.";
}

// Cerrar la conexión
$conexion->cerrar();
?>
