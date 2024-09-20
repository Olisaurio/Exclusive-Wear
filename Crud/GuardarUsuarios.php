<?php
    include("../ConexionLogin.php");
    $conexion = conexion();
    
    $Id = null;
    $NombreUsuario = $_POST ['NombreUsuario'];
    $Password = $_POST ['Password'];
    $Email= $_POST ['Email'];

    $sql = "INSERT INTO usuarios VALUES ('$Id','$Password', '$Email')";
    $query = mysqli_query ($conexion, $sql);

    if($query) {
        echo "<script> alert('El registro se guardo con exito  !!! $NombreUsuario');
            Location.href = 'Index.php' </script>";
            
        //header("Location: Index.php");
    }

    else {
        echo "Hay un error ";
    }

?>