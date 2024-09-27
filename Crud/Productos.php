<?php
include 'conexion.php';

// Llamar a la función para establecer la conexión
$conexion = conexion();

// Insertar nuevo producto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $imagen = $_POST['imagen'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Existencias, Imagen, Categoria) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdiis", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria);
    $stmt->execute();
}

// Eliminar producto
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM productos WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Obtener todos los productos
$result = $conexion->query("SELECT * FROM productos");
?>

<?php include 'headerCrud.php'; ?>

<style>
    /* Estilos generales */
    body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7; /* Fondo gris claro */
    color: #444; /* Texto gris oscuro */
}

/* Encabezado */
h1 {
    text-align: center;
    color: #444; /* Color morado */
}

/* Formulario */
form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff; /* Fondo blanco para el formulario */
    border: 1px solid #ccc; /* Borde gris claro */
    border-radius: 5px;
}

form input, form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #bbb; /* Borde gris medio */
    border-radius: 5px;
}

form button {
    width: 100%;
    padding: 10px;
    background-color: #ff0000; /* Color rojo */
    color: white; /* Color del texto del botón */
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color: #8b0000; /* Color rojo oscuro */
}

/* Tabla */
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc; /* Bordes de la tabla en gris claro */
}

th {
    background-color: #ff0000; /* Color rojo para los encabezados de la tabla */
    color: white; /* Color del texto de los encabezados */
}

td {
    padding: 10px;
}

/* Imagen en tabla */
td img {
    max-width: 50px; /* Ancho máximo de las imágenes */
}

/* Enlaces */
a {
    color: #ff0000; /* Color rojo para los enlaces */
}

a:hover {
    text-decoration: underline; /* Subrayar al pasar el ratón */
}
</style>


<h1>Gestionar Productos</h1>

<!-- Formulario para agregar nuevo producto -->
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <textarea name="descripcion" placeholder="Descripción" required></textarea>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="existencias" placeholder="Existencias" required>
    <input type="text" name="imagen" placeholder="URL Imagen" required>
    <input type="text" name="categoria" placeholder="Categoría" required>
    <button type="submit" name="add">Agregar Producto</button>
</form>

<!-- Tabla para mostrar productos -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Existencias</th>
        <th>Imagen</th>
        <th>Categoría</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['Nombre']; ?></td>
            <td><?php echo $row['Descripcion']; ?></td>
            <td><?php echo $row['Precio']; ?></td>
            <td><?php echo $row['Existencias']; ?></td>
            <td><img src="<?php echo $row['Imagen']; ?>" width="50" height="50"></td>
            <td><?php echo $row['Categoria']; ?></td>
            <td>
                <a href="?delete=<?php echo $row['Id']; ?>">Eliminar</a>
                <a href="editarProducto.php?id=<?php echo $row['Id']; ?>">Editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>