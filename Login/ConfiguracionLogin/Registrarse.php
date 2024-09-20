<?php
session_start(); // Iniciar la sesión

// Verificar si se han enviado los datos necesarios
if (isset($_POST['NombreUsuario']) && isset($_POST['Email']) && isset($_POST['Password'])) {
    $NombreUsuario = $_POST['NombreUsuario'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    // Conexión a la base de datos (ajusta los parámetros según tu configuración)
    $conexion = new mysqli("bpglbioljgviaczpauqk-mysql.services.clever-cloud.com", "uljaujvaprjxaclv", "EZ7KuEt9xpePTwELS6bK", "bpglbioljgviaczpauqk");

    // Verificar si hay errores en la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Verificar si el nombre de usuario ya existe
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
        // Insertar nuevo usuario
        $PasswordHasheada = password_hash($Password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuarios (Email, NombreUsuario, Password) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("sss", $Email, $NombreUsuario, $PasswordHasheada);
        
        if (!$stmt_insert->execute()) {
            echo "Error al crear el usuario: " . $stmt_insert->error;
            header("location: ../Registrarse.php?error=Error al crear el usuario");
            exit();
        } else {
            // Obtener el ID del nuevo usuario
            $_SESSION['user_id'] = $stmt_insert->insert_id; // Guardar ID del usuario en sesión
            $_SESSION['NombreUsuario'] = $NombreUsuario; // Guardar nombre de usuario en sesión
            header("location: ../../Index.php?success=Usuario creado con éxito!");
            exit();
        }
        
        // Cerrar la declaración de inserción
        $stmt_insert->close();
    }
    
    // Cerrar la declaración de verificación
    $stmt->close();
    
} else {
    header("location: ../Registrarse.php?error=Datos incompletos");
    exit();
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>