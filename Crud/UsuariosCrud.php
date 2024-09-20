<?php
    include("Conexion.php");
    $conexion = conexion();
    $sql = "SELECT * FROM usuarios";
    $query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Crud</title>
    <link rel="stylesheet" href="x.css">
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>

    <div class="Formulario">

    </div>

    <div class="Tabla">
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
    </div>
</body>
</html>