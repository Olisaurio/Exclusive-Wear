<?php

include 'conexion.php';

// Llamar a la función para establecer la conexión
$conexion = conexion();

// Crear producto
function crearProducto($nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor) {
    $conexion = conexion();
    $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Existencias, Imagen, Categoria, Id_Proveedor) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssdisii", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Actualizar producto
function actualizarProducto($id, $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor) {
    $conexion = conexion();
    $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Existencias = ?, Imagen = ?, Categoria = ?, Id_Proveedor = ? WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        echo "Error en la preparación de la consulta: " . $conexion->error;
        return false;
    }
    
    $stmt->bind_param("ssdiisii", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor, $id);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return false;
    }
    
    $afectadas = $stmt->affected_rows;
    $stmt->close();
    $conexion->close();
    
    echo "Filas afectadas: " . $afectadas;
    return $afectadas > 0;
}

// Eliminar producto
function eliminarProducto($id) {
    $conexion = conexion();
    $sql = "DELETE FROM productos WHERE Id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Consultar productos
function obtenerProductos() {
    $conexion = conexion();
    $sql = "SELECT * FROM productos";
    return mysqli_query($conexion, $sql);
}
?>