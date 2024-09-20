<?php
    session_start();
    
    include_once('Conexion.php');
    
    if (isset($_POST["Usuario"]) && isset($_POST["Password"])) {
        
        function Validar($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        $Usuario = Validar($_POST["Usuario"]);
        $Password = Validar($_POST["Password"]);
        
        if (empty($Usuario)) {
            header("location: ../IndexCrud.php?error=El usuario es requerido");
            exit();}
            
        elseif (empty($Password)) {
            header("location: ../IndexCrud.php?error=La clave es requerida");
            exit();}

        else {
            $sql = "SELECT * FROM usuarios WHERE Usuario = '$Usuario'";
            $query = mysqli_query($conexion, $sql);
            
            if ($query->num_rows==1) {
            $UsuarioQ = $query->fetch_assoc();
            
                $Id = $NombreUsuario["Id"];
                $NombreUsuario = $UsuarioQ["NombreUsuario"];
                $Password = $NombreUsuario["Clave"];
                $Email = $UsuarioQ["Email"];
            
                if ($NombreUsuario === $NombreUsuario) {
                    if (password_verify($Password, $P)) {
                        $_SESSION["Id"] = $Id;
                        $_SESSION["NombreUsuario"] = $NombreUsuario;
                        $_SESSION["Email"] = $Email;

                        echo "<script>
                            alert('Bienvenido $NombreUsuario');location.href = 'Crud.php'
                            </script>";}
                        else {
                            header("location: IndexCrud.php?error=Usuario o Clave incorrecta");}}
                    else {
                    header("location: IndexCrud.php?error=Usuario o Clave incorrecta");}}
                else {
                    header("location: IndexCrud.php?error=Usuario o Clave incorrecta");}}}