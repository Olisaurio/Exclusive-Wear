<?php
session_start();
require 'conexion.php';
require 'UsuariosCrud.php';

$conexion = conexion();

if (!isset($_GET['id'])) {
    header("Location: Usuarios.php");
    exit();
}

$id = $_GET['id'];

// Leer usuario
$sql = "SELECT * FROM usuarios WHERE Id = ?";
if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Actualizar usuario
    actualizarUsuario($id, $_POST['nombreUsuario'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']);
    header("Location: usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
     <title>Editar Usuario</title>
 </head>
<body>

<h1>Editar Usuario</h1>

<form method="POST">
     Nombre de Usuario: <input type="text" name="nombreUsuario" value="<?php echo htmlspecialchars($usuario['NombreUsuario']); ?>" required><br />
     Contraseña: <input type="password" name="password"><br /> <!-- Puedes dejar el campo vacío si no quieres cambiar la contraseña -->
     Email: <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['Email']); ?>"><br />
     <!-- Puedes agregar más campos según sea necesario -->
     
     <!-- Botón para actualizar usuario -->
     <button type="submit">Actualizar Usuario</button><br />
 </form>

<a href="usuarios.php">Volver a la lista de usuarios</a>

 </body></html>
