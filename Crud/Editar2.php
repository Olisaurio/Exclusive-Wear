<?php
    include("../ConexionLogin.php");
    $conexion = conexion();

    $Id = $_POST ['Id'];
    $NombreUsuario = $_POST ['NombreUsuario'];
    $password = $_POST ['Password'];
    $Email = $_POST ['Email'];

    $sql = "UPDATE usuarios SET NombreUsuario='$NombreUsuario',Password='$Password',Email='$Email' WHERE ID='$ID'";
    $query = mysqli_query ($conexion, $sql);

    if($query) {
        echo "<script> alert('El registro se edito con exito  !!!');
            location.href = 'Index.php' </script>";
            
        //header("Location: Index.php");
    }

    else {
        echo "Hay un error ";
    }
?>