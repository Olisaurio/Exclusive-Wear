<?php
session_start();
include("Crud/Conexion.php");
$conexion = conexion();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXCLUSIVE WEAR</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="shortcut icon" href="./Imagenes/LOGOS/LOGO.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<header>
    <nav>
        <div class="HeaderGeneral">
            <a href="/Crud/Usuarios.php" class="LogoHeader"><img src="./Imagenes/LOGOS/LOGO.png" alt=""></a>
            <div class="LoginCarrito">
                <?php if (isset($_SESSION['NombreUsuario'])): ?>
                    <span class="NombreUsuario"><?php echo htmlspecialchars($_SESSION['NombreUsuario']); ?></span>
                    <button class="LogoutButton">
                        <a href="./Login/CerrarSesion.php">Cerrar sesión</a>
                    </button>
                <?php else: ?>
                    <button class="LoginButton">
                        <a href="./Login/IndexLogin.php">Login</a>
                    </button>
                <?php endif; ?>

                <button class="CarritoButton">
                <a href="CarritoCompras/viewCart.php">A</a>
                </button>
            </div>
        </div>
        <a href="index.php">inicio</a>
        <a href="Masculino.php">Masculino</a>
        <a href="Femenino.php">Femenino</a>
        <a href="Promociones.php">Promociones</a>
        <a href="Contactanos.php">Contactanos</a>
    </nav>
</header>
