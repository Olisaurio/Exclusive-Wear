<?php
include("Conexion.php");
$conexion = conexion();
$sql = "SELECT * FROM usuarios";
$query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./StyleCrud/StyleIndexCrud.css">
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO-COMPLETO.png">
</head>

<body>
    <div class="Formulario">
        <form action="./Crud.php" method="POST">
            <a href="../Index.php">Volver</a>
            <h1>Ingresar</h1>
            <label for="">Email</label>
            <input type="email" name="Email"> <br><br>
            <label for="">Password</label>
            <input type="password" name="Password"> <br><br>
            <input type="submit" value="Iniciar Sesion">
        </form>
    </div>

</body>

</html>