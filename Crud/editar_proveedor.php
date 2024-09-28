<?php
session_start();
require 'conexion.php';
require 'ProveedoresCrud.php';
$conexion = conexion();

if (!isset($_GET['id'])) {
    header("Location: proveedores.php");
    exit();
}

$id = $_GET['id'];

// Leer proveedor
$sql = "SELECT * FROM proveedores WHERE Id = ?";
if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $proveedor = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Actualizar proveedor
    actualizarProveedor($id, $_POST['nombre'], $_POST['telefono'], $_POST['email'], $_POST['direccion'], $_POST['ciudad'], $_POST['pais']);
    header("Location: proveedores.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
</head>
<body>
<h1>Editar Proveedor</h1>

<form method="POST">
    Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($proveedor['Nombre']); ?>" required><br>
    Teléfono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($proveedor['Telefono']); ?>"><br>
    Email: <input type="email" name="email" value="<?php echo htmlspecialchars($proveedor['Email']); ?>"><br>
    Dirección: <input type="text" name="direccion" value="<?php echo htmlspecialchars($proveedor['Direccion']); ?>"><br>
    Ciudad: <input type="text" name="ciudad" value="<?php echo htmlspecialchars($proveedor['Ciudad']); ?>"><br>
    País: <input type="text" name="pais" value="<?php echo htmlspecialchars($proveedor['Pais']); ?>"><br>
    <button type="submit">Actualizar Proveedor</button>
</form>

<a href="proveedores.php">Volver a la lista de proveedores</a>

</body>
</html>