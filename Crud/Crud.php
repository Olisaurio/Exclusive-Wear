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
    <title>Crud Exclusive wear</title>
    <link rel="stylesheet" href="./StyleCrud/StyleCrud.css">
    <link rel="shortcut icon" href="../Imagenes/LOGOS/LOGO.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&display=swap" rel="stylesheet">
</head>

<body>
    <header>
            <nav>
                <img src="../Imagenes/LOGOS/LOGO.png" alt="" class="Logo">
                <a href="./UsuariosCrud.php">Usuarios</a>
                <a href="./CrudMasculino.php">Masculino</a>
                <a href="#">Mujer</a>
                <a href="#">Promociones</a>
                <a href="#">Contactanos</a>
            </nav>
    </header>
    <div class="Contenedor-General">
        <div class="Formulario">
            <a href="../Index.php">Volver</a>
            <h1>Crear Usuario</h1>
            <form action="Guardar.php" method="POST">
                <input type="text" name="nombres" id placeholder="Nombre" required>
                <br><br>
                <input type="text" name="apellidos" id placeholder="Apellidos" required> <br><br>
                <input type="text" name="usuarios" id placeholder="Usuario" required>
                <br><br>
                <input type="password" name="password" id placeholder="Contraseña" required> <br><br>
                <input type="email" name="correo" id placeholder="Correo Electronico" required> <br><br>
                <input type="submit" value="Guardar">
            </form>
        </div>

        <div class="tabla">
            <h1>Usuarios registrados</h1>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Correo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                            while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?=$row['Id']?></td>
                        <td><?=$row['NombreUsuario']?></td>
                        <td><?=$row['ApellidoUsuario']?></td>
                        <td><?=$row['Usuario']?></td>
                        <td><?=$row['Password']?></td>
                        <td><?=$row['Email']?></td>
                        <td><a href="Actualizar.php?Id=<?=$row['Id']?>">Editar</a></td>
                        <td><a href="Eliminar.php?Id=<?=$row['Id']?>">Eliminar</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>