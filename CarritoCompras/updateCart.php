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

$conexion = conexion();

if (!isset($_SESSION['user_id'])) {
    header("Location: Login/ConfiguracionLogin/Login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $product_id = $_POST['product_id']; 

    if ($_POST['action'] == 'remove') {
        // Eliminar producto del carrito
        $sql = "DELETE FROM articulos_carrito WHERE Id_Carrito = ? AND Id_Producto = ?";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("ii", $cart_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($_POST['action'] == 'increase') {
        // Incrementar cantidad
        $sql = "UPDATE articulos_carrito SET Cantidad = Cantidad + 1 WHERE Id_Carrito = ? AND Id_Producto = ?";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("ii", $cart_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    } elseif ($_POST['action'] == 'decrease') {
        // Decrementar cantidad
        $sql = "UPDATE articulos_carrito SET Cantidad = Cantidad - 1 WHERE Id_Carrito = ? AND Id_Producto = ? AND Cantidad > 1";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("ii", $cart_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

header("Location: viewCart.php");
exit();
?>
