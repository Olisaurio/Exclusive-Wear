<?php

include 'conexion.php';

$conexion = conexion();

// Crear usuario
function crearUsuario($nombreUsuario, $password, $email) {
    $conexion = conexion();
    $hashPassword = password_hash($password, PASSWORD_BCRYPT); // Hasheando el password
    $sql = "INSERT INTO usuarios (NombreUsuario, Password, Email) VALUES (?, ?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sss", $nombreUsuario, $hashPassword, $email);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Actualizar usuario
function actualizarUsuario($id, $nombreUsuario, $password, $email) {
    $conexion = conexion();
    $hashPassword = password_hash($password, PASSWORD_BCRYPT); // Hasheando el password
    $sql = "UPDATE usuarios SET NombreUsuario = ?, Password = ?, Email = ? WHERE Id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssi", $nombreUsuario, $hashPassword, $email, $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Eliminar usuario
function eliminarUsuario($id) {
    $conexion = conexion();
    $sql = "DELETE FROM usuarios WHERE Id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    $conexion->close();
}

// Consultar usuarios
function obtenerUsuarios() {
    $conexion = conexion();
    $sql = "SELECT * FROM usuarios";
    $result = mysqli_query($conexion, $sql);
    $usuarios = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $usuarios[] = $row;
    }
    $conexion->close();
    return $usuarios;
}
?>
