<?php
include ('../ConexionLogin.php');
$conexion = conexion ();
$sql = "select * from usuarios ";
$query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO-COMPLETO.png">
    <link rel="stylesheet" href="Style.css">

    <style>
    .contenedor-tabla {
        background-color: blueviolet;
        border-radius: 15px;
        width: 330px;
        padding: 50px;
        margin: 50ps auto;
        text-align: center;
        margin-bottom: 30px;
        box-shadow: 0 20px 35px rgba (0, 0, 0, 0.5);
    }
    </style>
</head>

<body>
    <div class="formulario_login_crear">

        <form action="/Crud/GuardarUsuarios.php" method="post">
            <input type="text" name="usuario" id="" placeholder="Digite el nombre de usuario"><br><br>
            <input type="text" name="password" id="" placeholder="Digite una contraseña"><br><br>
            <button type="submit">Guardar</button><br>
        </form>

    </div>

    <div class="ContenedorTabla">
        <h1>Usuarios Registrados</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Email</th>
                    < </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?=$row['Id']?></td>
                    <td><?=$row['NombreUsuario']?></td>
                    <td><?=$row['Password']?></td>
                    <td><?=$row['Email']?></td>
                    <td><a href="Actualizar2.php?Id=<?=$row['Id']?>">Editar</a></td>
                    <td><a href="Eliminar2.php?Id=<?=$row['Id']?>">Eliminar</a></td>
                </tr>
                <?php endwhile;?>

    </div>
</body>

</html>