<?php
// Función para establecer la conexión con la base de datos
include 'conexion.php';

// Llamar a la función para establecer la conexión
$conexion = conexion();


// Insertar nuevo usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (NombreUsuario, Email, Password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $password);
    $stmt->execute();
}

// Eliminar usuario
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM usuarios WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Obtener todos los usuarios
$result = $conexion->query("SELECT * FROM usuarios");
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
    max-width: 400px;
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


<h1>Gestionar Usuarios</h1>

<!-- Formulario para agregar nuevo usuario -->
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre Usuario" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="add">Agregar Usuario</button>
</form>

<!-- Tabla para mostrar usuarios -->
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre Usuario</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['NombreUsuario']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td>
                <a href="?delete=<?php echo $row['Id']; ?>">Eliminar</a>
                <a href="editar_usuario.php?id=<?php echo $row['Id']; ?>">Editar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
