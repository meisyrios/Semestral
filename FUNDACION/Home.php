<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Si no está logueado, redirigir al login
    header("Location: login.html"); // Redirigir a la página de login
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a UNIENDO HUELLITAS</title>
    <link rel="stylesheet" href="Home.css">
</head>
<body>

<header>
    <a href="#" class="logo"> 
        <img src="logofundacion3.jpg" alt="Logo de la Veterinaria">
        <h2 class="empresa"> UNIENDO HUELLITAS🐾 </h2>
    </a>
    <nav>
        <a href="salvandovidas.html" class="nav-link">Salvando vidas</a>
        <a href="Encuentra tu compañero.html" class="nav-link">Encuentra tu compañero</a>
        <a href="unetealacausa.html" class="nav-link">Únete a la causa</a>
        <a href="contactanos.html" class="nav-link">Contactanos</a>
        <!-- Mostrar el nombre de usuario si está logueado -->
        <span>Hola, <?php echo $_SESSION['username']; ?>!</span>
        <a href="logout.php" class="logout-link">Cerrar sesión</a>
    </nav>
</header>

<main>
    <section>
        <h1>Bienvenido a la página principal de UNIENDO HUELLITAS</h1>
        <p>Contenido de la página...</p>
    </section>
</main>

<footer>
    <p><strong>Ubicación:</strong> Bethania, República de Panamá</p>
    <p><strong>Correo:</strong> <a href="mailto:info@uniendohuellitas.org">info@uniendohuellitas.org</a></p>
    <p>&copy; 2024 UNIENDO HUELLITAS. Todos los derechos reservados.</p>
</footer>

</body>
</html>
