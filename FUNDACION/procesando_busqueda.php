<?php
// Incluir el archivo que contiene la clase Conecta
include 'conexion.php';

// Crear una instancia de la clase Conecta
$conecta = new Conecta();

// Llamar al método conectarDB() para establecer la conexión
$conexion = $conecta->conectarDB();

// Verificar si la conexión fue exitosa
if ($conexion) {
    // Aquí puedes hacer las operaciones que desees con la base de datos.
    // Por ejemplo, insertar los datos del formulario en la base de datos.
    echo "<p>Conexión exitosa a la base de datos.</p>";
    
    // Puedes realizar consultas a la base de datos aquí (ejemplo de inserción)
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $telefono = $conexion->real_escape_string($_POST['telefono']);
    $animalNombre = $conexion->real_escape_string($_POST['animal-nombre']);
    $motivo = $conexion->real_escape_string($_POST['motivo']);
    $hogar = $conexion->real_escape_string($_POST['hogar']);
    $mascotas = $conexion->real_escape_string($_POST['mascotas']);
    $responsabilidad = $conexion->real_escape_string($_POST['responsabilidad']);

    // Inserción en la base de datos (ajustar según tu estructura de tabla)
    $query = "INSERT INTO buscando_amigo (nombre, correo, telefono, animal_nombre, motivo, hogar, mascotas, responsabilidad) 
              VALUES ('$nombre', '$correo', '$telefono', '$animalNombre', '$motivo', '$hogar', '$mascotas', '$responsabilidad')";

    if ($conexion->query($query) === TRUE) {
        echo "<p>Datos de adopción guardados correctamente.</p>";
    } else {
        echo "<p>Error al guardar los datos: " . $conexion->error . "</p>";
    }

    // Cerrar la conexión
    $conecta->cerrar();
} else {
    echo "<p>Hubo un problema al conectar con la base de datos.</p>";
}
?>
