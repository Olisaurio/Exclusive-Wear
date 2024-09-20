<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse Exclusive Wear</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./StyleLogin/StyleRegistrarse.css">
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO.png">
</head>

<body>
    <div class="contenedor">
        <a href="./IndexLogin.php">Volver</a>
        <h1><ins>Registrarse</ins></h1>
        <br>
        <form action="ConfiguracionLogin/Registrarse.php" method="post">

            <?php if (isset($_GET["error"])) { ?>
            <p class="error">
                <?php echo $_GET ["error"] ?></p>
            <?php } ?>
            <br>

            <?php if (isset ($_GET["success"])) { ?>
            <p class="success"> <?php echo $_GET["success"] ?></p>
            <?php } ?>
            <br>

            <label for="">
                <i class="fa-solid fa-users"></i>
                Email
            </label>
            <input type="Email" placeholder="Email" name="Email"  require>

            <label for="">
                <i class="fa-solid fa-users"></i>
                Nombre Usuario
            </label>
            <input type="text" placeholder="Nombre Usuario" name="NombreUsuario"  require>

            <label for="">
                <i class="fa-solidfa-user "></i>
                Clave
            </label>
            <input type="password" name="Password" placeholder="Password">

            <label for="">
                <i class="fa-solidfa-user "></i>
                Repetir Clave
            </label>
            <input type="password" name="RPassword" placeholder="Repita Password">

            <input type="submit" class="button" value="Registrarse">
            <a href="./IndexLogin.php" class="Boton_Ingresar">Ingresar</a>
        </form>
    </div>
</body>

</html>