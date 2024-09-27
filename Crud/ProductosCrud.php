<?php
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
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssdisiii", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor, $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
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
    $result = mysqli_query($conexion, $sql);
    $productos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $productos[] = $row;
    }
    $conexion->close();
    return $productos;
}
?>
