<?php
session_start();
include("../ConexionLogin.php");

$conexion = conexion();

if (isset($_POST['NombreUsuario']) && isset($_POST['Password'])) {
    $NombreUsuario = $_POST['NombreUsuario'];
    $Password = $_POST['Password'];

    if ($conexion) {
        $NombreUsuario = mysqli_real_escape_string($conexion, $NombreUsuario);

        $sql = "SELECT * FROM usuarios WHERE NombreUsuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $NombreUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            
            if (password_verify($Password, $usuario['Password'])) {
                $_SESSION['NombreUsuario'] = $usuario['NombreUsuario'];
                $_SESSION['user_id'] = $usuario['Id'];

                header("location: /index.php?success=Usuario loguaado con éxito!");
                exit();
            } else {
                echo "<script>
                        alert('ERROR: Contraseña incorrecta!');
                        location.href = '../IndexLogin.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('ERROR: Usuario no encontrado!');
                    location.href = '../IndexLogin.php';
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('ERROR: No se pudo conectar a la base de datos!');
                location.href = '../IndexLogin.php';
              </script>";
    }

    mysqli_close($conexion);
} else {
    echo "<script>
            alert('ERROR: Por favor ingrese todos los datos!');
            location.href = '../IndexLogin.php';
          </script>";
}
?>