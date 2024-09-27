<?php
include 'conexion.php';
include 'ProductosCrud.php';

// Activar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Llamar a la función para establecer la conexión
$conexion = conexion();

// Verificar si se ha proporcionado un ID de producto
if (!isset($_GET['id'])) {
    die("Error: No se proporcionó un ID de producto.");
}

$id = $_GET['id'];

// Obtener los datos del producto
$sql = "SELECT * FROM productos WHERE Id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

if (!$producto) {
    die("Error: No se encontró el producto.");
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>Datos POST recibidos: ";
    print_r($_POST);
    echo "</pre>";

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $imagen = $_POST['imagen'];
    $categoria = $_POST['categoria'];
    $id_proveedor = $_POST['id_proveedor'];

    // Asegúrate de que la función actualizarProducto maneje correctamente todos los campos
    $resultado = actualizarProducto($id, $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor);
    
    if ($resultado) {
        echo "Producto actualizado correctamente.";
    } else {
        echo "Error al actualizar el producto.";
    }
    
    // Comentamos la redirección para ver los mensajes de depuración
    // header("Location: Productos.php");
    // exit();
}

// Obtener la lista de proveedores
$sql_proveedores = "SELECT Id, Nombre FROM proveedores";
$result_proveedores = $conexion->query($sql_proveedores);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        /* ... (estilos sin cambios) ... */
    </style>
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="POST">
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['Nombre']); ?>" required>
        <textarea name="descripcion" required><?php echo htmlspecialchars($producto['Descripcion']); ?></textarea>
        <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['Precio']); ?>" required>
        <input type="number" name="existencias" value="<?php echo htmlspecialchars($producto['Existencias']); ?>" required>
        <input type="text" name="imagen" value="<?php echo htmlspecialchars($producto['Imagen']); ?>" required>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($producto['Categoria']); ?>" required>
        <select name="id_proveedor">
            <?php while ($proveedor = $result_proveedores->fetch_assoc()): ?>
                <option value="<?php echo $proveedor['Id']; ?>" <?php echo ($proveedor['Id'] == $producto['Id_Proveedor']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($proveedor['Nombre']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Actualizar Producto</button>
    </form>
</body>
</html>