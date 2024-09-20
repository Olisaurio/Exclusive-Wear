<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Exclusive Wear</title>
    <link rel="stylesheet" href="./StyleLogin/StyleRegistrarse.css">
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO.png">
</head>

<body>
    <div class="contenedor">
        <h1><ins>Iniciar Sesión</ins></h1>
        <form action="ConfiguracionLogin/Login.php" method="post">
            <label for="NombreUsuario">Nombre Usuario</label>
            <input type="text" name="NombreUsuario" placeholder="Nombre Usuario" required>

            <label for="Password">Clave</label>
            <input type="password" name="Password" placeholder="Password" required>

            <input type="submit" class="button" value="Iniciar Sesión">
            <a href="./Registrarse.php" class="Boton_Ingresar">Registrarse</a>
        </form>
    </div>
</body>

</html>