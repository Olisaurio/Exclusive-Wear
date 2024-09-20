<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función de conexión a la base de datos
function conexion() {
    $host = "bpglbioljgviaczpauqk-mysql.services.clever-cloud.com";
    $user = "uljaujvaprjxaclv";
    $pass = "EZ7KuEt9xpePTwELS6bK";
    $bd = "bpglbioljgviaczpauqk";

    $conexion = mysqli_connect($host, $user, $pass, $bd);
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    return $conexion;
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: /api/login/IndexLogin.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$conexion = conexion();

// Obtener el carrito del usuario
$sql = "SELECT carrito.Id AS cart_id, productos.Id AS product_id, productos.Nombre AS name, 
               productos.Precio AS price, productos.Imagen AS image, articulos_carrito.Cantidad AS quantity 
        FROM articulos_carrito 
        JOIN carrito ON articulos_carrito.Id_Carrito = carrito.Id 
        JOIN productos ON articulos_carrito.Id_Producto = productos.Id 
        WHERE carrito.Id_Usuario2 = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$query = $stmt->get_result();

if (!$query) {
    die("Error en la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <style>
        body {
    font-family: "Baskervville SC";
    background-image: url(/Imagenes/Fondo/blurry-gradient-haikei.svg);
}
        h1 {
            color: #dc3545; /* Rojo */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            color: #dee2e6;
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6; /* Gris claro */
        }
        th {
            background-color: #343a40; /* Negro */
            color: white; /* Blanco */
        }
        .button {
            background-color: #dc3545; /* Rojo */
            color: white; /* Blanco */
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #c82333; /* Rojo más oscuro */
        }
        .total {
            font-size: 1.5em;
            margin-top: 20px;
            color: #dc3545; /* Rojo */
        }
        @media (max-width: 600px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            th, td {
                font-size: 14px; /* Tamaño de fuente más pequeño en pantallas pequeñas */
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Tu Carrito de Compras</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0; 
            ?>
            <?php if ($query->num_rows > 0): ?>
                <?php while ($row = $query->fetch_assoc()): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" width="50"></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td>$<?php echo number_format($row['quantity'] * floatval($row['price']), 2); ?></td>
                        <td>
                            <form method="POST" action="updateCart.php">
                                <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($row['cart_id']); ?>">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['product_id']); ?>"> <!-- Asegúrate de que este campo esté presente -->
                                <button type="submit" name="action" value="remove" class="button">Eliminar</button>
                                <button type="submit" name="action" value="increase" class="button">+</button>
                                <button type="submit" name="action" value="decrease" class="button">-</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                    // Acumular total
                    $total += ($row['quantity'] * floatval($row['price'])); 
                    ?>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tu carrito está vacío.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2 class="total">Total: $<?php echo number_format($total, 2); ?></h2>

    <?php if ($query->num_rows > 0): ?>
        <a href="checkout.php" class="button">Proceder al Pago</a>
    <?php endif; ?>

    <a href="/Promociones.php" class="button">Seguir viendo Productos</a>

</body>
</html>

<?php
$stmt->close();
mysqli_close($conexion);
?>