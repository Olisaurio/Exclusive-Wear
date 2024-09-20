<?php
include("../ConexionLogin.php");
$conexion = conexion();

$ID = $_GET['Id'];

$sql = "DELETE FROM usuarios WHERE Id = '$Id'";
$query = mysqli_query($conexion, $sql);

if($query) {
    echo "<script> alert('El registro se Elimino con exito  !!! $NombreUsuario')
        Location:href = 'Index.php' </script>";
        
}

else {
    echo "Hay un error ";
}
?>