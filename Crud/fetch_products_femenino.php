<?php
include("Conexion.php");
$conexion = conexion();

function obtenerProductosPorCategoria($conexion, $categoria) {
    $sql = "SELECT * FROM productos WHERE Categoria = '$categoria'";
    $query = mysqli_query($conexion, $sql);

    if (!$query) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    while ($row = mysqli_fetch_assoc($query)) {
        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($row['Imagen']) . '" alt="' . htmlspecialchars($row['Nombre']) . '">';
        echo '<h3>' . htmlspecialchars($row['Nombre']) . '</h3>';
        echo '<p>Precio: $' . number_format($row['Precio'], 2) . '</p>';
        
        // Formulario para agregar al carrito
        echo '<form method="POST" action="CarritoCompras/addToCart.php">';
        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['Id']) . '">';
        echo '<button type="submit" class="add-to-cart">Agregar al Carrito</button>';
        echo '</form>';

        echo '</div>';
    }
}

// Llama a la función para obtener productos de la categoría 'masculino'
obtenerProductosPorCategoria($conexion, 'femenino');

// Cierra la conexión
mysqli_close($conexion);
?>