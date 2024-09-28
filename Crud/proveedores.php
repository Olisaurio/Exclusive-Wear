<?php
include 'conexion.php';

$conexion = conexion();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];

    $sql = "INSERT INTO proveedores (Nombre, Telefono, Email, Direccion, Ciudad, Pais) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $telefono, $email, $direccion, $ciudad, $pais);
    $stmt->execute();
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM proveedores WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}


$result = $conexion->query("SELECT * FROM proveedores");
?>

<?php include 'headerCrud.php'; ?>

<style>
    /* Estilos generales */
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}

/* Encabezado */
h1 {
    text-align: center;
    color: red; /* Color del encabezado */
}

/* Formulario */
form {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
}

form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button {
    width: 100%;
    padding: 10px;
    background-color: red; /* Color del botón */
    color: white; /* Color del texto del botón */
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button:hover {
    background-color: darkred; /* Color del botón al pasar el ratón */
}

/* Tabla */
table {
    background: #fff;
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black; /* Bordes de la tabla en negro */
}

th {
    background-color: red; /* Color de fondo de los encabezados de la tabla */
    color: white; /* Color del texto de los encabezados */
}

td {
    padding: 10px;
}

/* Enlaces */
a {
    color: red; /* Color de los enlaces */
}

a:hover {
    text-decoration: underline; /* Subrayar al pasar el ratón */
}
</style>


<h1>Gestionar Proveedores</h1>

<!-- Formulario para agregar nuevo proveedor -->
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="telefono" placeholder="Teléfono">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="direccion" placeholder="Dirección">
    <input type="text" name="ciudad" placeholder="Ciudad">
    <input type="text" name="pais" placeholder="País">
    <button type="submit" name="add">Agregar Proveedor</button>
</form>

<!-- Tabla para mostrar proveedores -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Ciudad</th>
        <th>País</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['Nombre']; ?></td>
            <td><?php echo $row['Telefono']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Direccion']; ?></td>
            <td><?php echo $row['Ciudad']; ?></td>
            <td><?php echo $row['Pais']; ?></td>
            <td>
                <a href="?delete=<?php echo $row['Id']; ?>">Eliminar</a>
                <a href="editar_proveedor.php?id=<?php echo $row['Id']; ?>">Editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
