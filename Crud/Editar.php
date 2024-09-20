<?php
    include("Conexion.php");
    $conexion = conexion();

    $Id = $_POST ['Id'];
    $NombreUsuario = $_POST ['NombreUsuario'];
    $Apellidousuario = $_POST ['ApellidoUsuario'];
    $Usuario = $_POST ['Usuario'];
    $Password = $_POST ['Password'];
    $Email = $_POST ['Email'];

    $sql = "UPDATE usuarios SET NombreUsuario='$NombreUsuario',ApellidoUsuario='$ApellidoUsuario',Usuario='$Usuario',Password='$Password',Email='$Email' WHERE Id='$Id'";
    $query = mysqli_query ($conexion, $sql);

    if($query) {
        echo "<script> alert('El registro se edito con exito  !!!');
            location.href = './Crud.php' </script>";
            
        //header("Location: Index.php");
    }

    else {
        echo "<script> alert('El registro se edito con exito  !!!');
            location.href = './Crud.php' </script>";
    }
?>