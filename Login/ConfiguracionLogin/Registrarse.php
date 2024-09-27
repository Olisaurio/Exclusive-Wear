<?php
session_start();

if (isset($_POST['NombreUsuario']) && isset($_POST['Email']) && isset($_POST['Password'])) {
    $NombreUsuario = $_POST['NombreUsuario'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $conexion = new mysqli("bpglbioljgviaczpauqk-mysql.services.clever-cloud.com", "uljaujvaprjxaclv", "EZ7KuEt9xpePTwELS6bK", "bpglbioljgviaczpauqk");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios WHERE NombreUsuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $NombreUsuario);
    
    if (!$stmt->execute()) {
        die("Error en la consulta: " . $stmt->error);
    }
    
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        header("location: ../Registrarse.php?error=El nombre de usuario ya existe");
        exit();
    } else {

        $PasswordHasheada = password_hash($Password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuarios (Email, NombreUsuario, Password) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $Email, $NombreUsuario, $PasswordHasheada);
        
        if (!$stmt_insert->execute()) {
            echo "Error al crear el usuario: " . $stmt_insert->error;
            header("location: ../Registrarse.php?error=Error al crear el usuario");
            exit();
        } else {
            $_SESSION['user_id'] = $stmt_insert->insert_id;
            $_SESSION['NombreUsuario'] = $NombreUsuario;
            header("location: ../../index.php?success=Usuario creado con éxito!");
            exit();
        }
        
        $stmt_insert->close();
    }
    
    $stmt->close();
    
} else {
    header("location: ../Registrarse.php?error=Datos incompletos");
    exit();
}

$conexion->close();
?>