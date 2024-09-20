<?php
// Include guard to prevent redeclaration
if (!function_exists('conexion')) {
    function conexion() {
        $host = "bpglbioljgviaczpauqk-mysql.services.clever-cloud.com";
        $user = "uljaujvaprjxaclv";
        $pass = "EZ7KuEt9xpePTwELS6bK";
        $bd = "bpglbioljgviaczpauqk";

        $conexion = mysqli_connect($host, $user, $pass, $bd);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }
        return $conexion;
    }
}
?>
