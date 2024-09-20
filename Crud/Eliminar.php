<?php
include("Conexion.php");
$conexion = conexion();

$Id = $_GET['Id'];

$sql = "DELETE FROM usuarios WHERE Id = '$Id'";
$query = mysqli_query($conexion, $sql);

if($query) {
    echo "<script> alert('El registro se Elimino con exito  !!!')
        Location:href = './Crud.php' </script>";
        
}

else {
    echo "Hay un error ";
}
?>