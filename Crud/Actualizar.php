<?php
include("Conexion.php");
$conexion = conexion();

$Id = $_GET['Id'];
$sql = "SELECT * FROM usuarios WHERE Id = '$Id'";
$query = mysqli_query($conexion, $sql);

$row = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario </title>
    <link rel="stylesheet" href="./StyleCrud/StyleActualizar.css">
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
</head>

<body>
    <div class="Contenedor_Actualizar">
        <h1>Actualizar Usuario</h1>
        <form action="Editar.php" method="POST">
            <input type="hidden" name="Id" value="<?=$row['Id']?>">
            <input type="text" name="NombreUsuario" id="" value="<?=$row['NombreUsuario']?>">
            <br><br>
            <input type="text" name="ApellidosUsuario" id="" value="<?=$row['ApellidoUsuario']?>">
            <br><br>
            <input type="text" name="Usuario" id="" value="<?=$row['Usuario']?>">
            <br><br>
            <input type="password" name="Password" id="" value="<?=$row['Password']?>">
            <br><br>
            <input type="email" name="Email" id="" value="<?=$row['Email']?>">
            <br><br>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>

</html>