<?php
    include("Conexion.php");
    $conexion = conexion();
    
    $Id = null;
    $NombreUsuario = $_POST ['NombreUsuario'];
    $ApellidoUsuario = $_POST ['ApellidoUsuario'];
    $Usuario = $_POST ['Usuario'];
    $Password = $_POST ['Password'];
    $Email = $_POST ['Email'];

    $sql = "INSERT INTO usuarios VALUES ('$Id','$NombreUsuario', '$ApellidoUsuario', '$Usuario', '$Password', '$Email')";
    $query = mysqli_query ($conexion, $sql);

    if($query) {
        echo "<script> alert('El registro se guardo con exito  !!! $NombreUsuario,$ApellidoUsuario');
            Location.href = './Crud.php' </script>";
            
        //header("Location: Index.php");
    }

    else {
        echo "Hay un error ";
    }

?>