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
//ENVIA CATEGORIA PERO NO IMAGEN
function actualizarProducto($id, $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor) {
    $conexion = conexion();
    $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Existencias = ?, Imagen = ?, Categoria = ?, Id_Proveedor = ? WHERE Id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdisssi", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor, $id);
    $resultado = $stmt->execute();
    $stmt->close();
    $conexion->close();
    return $resultado;
}

// ENVIA IMAGEN PERO NO CATEGORIA
// function actualizarProducto($id, $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor) {
//     $conexion = conexion();

//     $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Existencias = ?, Imagen = ?, Categoria = ?, Id_Proveedor = ? WHERE Id = ?";
//     $stmt = $conexion->prepare($sql);
//     $stmt->bind_param("ssdisisi", $nombre, $descripcion, $precio, $existencias, $imagen, $categoria, $id_proveedor, $id);
    
//     return $stmt->execute();
// }

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