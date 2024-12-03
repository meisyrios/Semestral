<?php
session_start(); // Iniciar la sesión

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'datos'); // Conectar a la base de datos 'datos'

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar al usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, obtener los datos
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Iniciar la sesión y almacenar los datos del usuario
            $_SESSION['user_id'] = $row['id']; // Almacenar el ID del usuario
            $_SESSION['username'] = $row['username']; // Almacenar el nombre de usuario

            // Redirigir al usuario a la página principal o donde desees
            header("Location: Home.php"); // Puedes redirigir a cualquier página que quieras
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El nombre de usuario no existe.";
    }

    $conn->close(); // Cerrar la conexión a la base de datos
}
?>
