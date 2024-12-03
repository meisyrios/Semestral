<?php
// Registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coincidan
    if ($password === $confirm_password) {
        // Encriptar la contraseña solo si las contraseñas coinciden
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Encriptar la contraseña

        // Conectar a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'datos'); // Conectar a la base de datos 'datos'

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Verificar si el nombre de usuario o el correo ya están registrados
        $sql = "SELECT * FROM usuarios WHERE username = '$username' OR email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El nombre de usuario o correo electrónico ya está registrado.";
        } else {
            // Insertar los datos del nuevo usuario en la base de datos
            $sql = "INSERT INTO usuarios (username, email, password) VALUES ('$username', '$email', '$password_hashed')";
            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                echo "Error al registrar: " . $conn->error;
            }
        }

        $conn->close(); // Cerrar la conexión a la base de datos
    } else {
        echo "Las contraseñas no coinciden. Por favor, verifica.";
    }
}
?>
