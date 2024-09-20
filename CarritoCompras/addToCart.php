<?php
session_start();
if (!function_exists('conexion')) {
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
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id']; // Asegúrate de que este valor provenga de un formulario o solicitud válida

$conexion = conexion();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('ERROR: Usuario no autenticado!');
            location.href = '/index.php';
          </script>";
    exit();
}


if ($conexion) {
    // Verificar si ya existe un carrito para el usuario
    $sql_check_carrito = "SELECT Id FROM carrito WHERE Id_Usuario2 = ?";
    $stmt_check_carrito = $conexion->prepare($sql_check_carrito);
    $stmt_check_carrito->bind_param("i", $user_id);
    $stmt_check_carrito->execute();
    $result = $stmt_check_carrito->get_result();
    
    if ($result->num_rows > 0) {
        // Obtener el ID del carrito
        $row = $result->fetch_assoc();
        $carrito_id = $row['Id'];
    } else {
        // Crear un nuevo carrito si no existe
        $sql_insert_carrito = "INSERT INTO carrito (Id_Usuario2, Creado_En) VALUES (?, NOW())";
        if ($stmt_insert_carrito = $conexion->prepare($sql_insert_carrito)) {
            $stmt_insert_carrito->bind_param("i", $user_id);
            if ($stmt_insert_carrito->execute()) {
                // Obtener el ID del carrito recién creado
                $carrito_id = $stmt_insert_carrito->insert_id;
            } else {
                echo "Error al crear el carrito: " . $stmt_insert_carrito->error;
                exit();
            }
            // Cerrar declaración del carrito
            $stmt_insert_carrito->close();
        }
    }

    // Verificar si el producto ya está en articulos_carrito
    $sql_check_product = "SELECT Cantidad FROM articulos_carrito WHERE Id_Carrito = ? AND Id_Producto = ?";
    if ($stmt_check_product = $conexion->prepare($sql_check_product)) {
        $stmt_check_product->bind_param("ii", $carrito_id, $product_id);
        $stmt_check_product->execute();
        $result_product = $stmt_check_product->get_result();

        if ($result_product->num_rows > 0) {
            // Si el producto ya está en el carrito, incrementar la cantidad
            if ($row_product = $result_product->fetch_assoc()) {
                // Incrementar la cantidad existente
                $new_quantity = intval($row_product['Cantidad']) + 1; // Incrementar en 1
                
                // Actualizar la cantidad en articulos_carrito
                $sql_update_quantity = "UPDATE articulos_carrito SET Cantidad = ? WHERE Id_Carrito = ? AND Id_Producto = ?";
                if ($stmt_update_quantity = $conexion->prepare($sql_update_quantity)) {
                    // Usar la nueva cantidad calculada
                    $stmt_update_quantity->bind_param("iii", $new_quantity, $carrito_id, $product_id);
                    if ($stmt_update_quantity->execute()) {
                        echo "<script>
                                alert('Cantidad actualizada en el carrito.');
                                location.href = '../Promociones.php'; // Redirigir a la página deseada
                              </script>";
                    } else {
                        echo "Error al actualizar la cantidad: " . $stmt_update_quantity->error;
                    }
                    // Cerrar declaración de actualización
                    $stmt_update_quantity->close();
                }
            }
        } else {
            // Si no está, añadirlo al carrito con cantidad inicial de 1
            $sql_insert_articulo_carrito = "INSERT INTO articulos_carrito (Id_Carrito, Id_Producto, Cantidad) VALUES (?, ?, ?)";
            if ($stmt_insert_articulo_carrito = $conexion->prepare($sql_insert_articulo_carrito)) {
                // Usar cantidad por defecto de 1 al insertar nuevo artículo
                $cantidad = 1; 
                $stmt_insert_articulo_carrito->bind_param("iii", $carrito_id, $product_id, $cantidad);
                if ($stmt_insert_articulo_carrito->execute()) {
                    echo "<script>
                            alert('Producto añadido al carrito con éxito.');
                            location.href = '../Promociones.php'; // Redirigir a la página deseada
                          </script>";
                } else {
                    echo "Error al añadir el producto al carrito: " . $stmt_insert_articulo_carrito->error;
                }
                // Cerrar declaración del artículo del carrito
                $stmt_insert_articulo_carrito->close();
            }
        }
    }
} else {
    echo "<script>
            alert('ERROR: No se pudo conectar a la base de datos!');
            location.href = '../Index.php';
          </script>";
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>