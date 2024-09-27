<?php
// Conexión a la base de datos
include 'conexion.php';

// Llamar a la función para establecer la conexión
$conexion = conexion();

// Crear proveedor
function crearProveedor($nombre, $telefono, $email, $direccion, $ciudad, $pais) {
    $conexion = conexion();
    $sql = "INSERT INTO proveedores (Nombre, Telefono, Email, Direccion, Ciudad, Pais) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssssss", $nombre, $telefono, $email, $direccion, $ciudad, $pais);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Actualizar proveedor
function actualizarProveedor($id, $nombre, $telefono, $email, $direccion, $ciudad, $pais) {
    $conexion = conexion();
    $sql = "UPDATE proveedores SET Nombre = ?, Telefono = ?, Email = ?, Direccion = ?, Ciudad = ?, Pais = ? WHERE Id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ssssssi", $nombre, $telefono, $email, $direccion, $ciudad, $pais, $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Eliminar proveedor
function eliminarProveedor($id) {
    $conexion = conexion();
    $sql = "DELETE FROM proveedores WHERE Id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Consultar proveedores
function obtenerProveedores() {
    $conexion = conexion();
    $sql = "SELECT * FROM proveedores";
    $result = mysqli_query($conexion, $sql);
    $proveedores = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $proveedores[] = $row;
    }
    $conexion->close();
    return $proveedores;
}
?>
