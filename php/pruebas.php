<?php
/*
session_start();
echo $_SESSION['id_usuario'];
echo "<br>";
include 'Conexion.php';
$obj = new Conexion();
    $obj -> query("Select * from contacto");
    $respuesta = $obj -> resultSet();
    print_r($respuesta);
    session_destroy();*/
    //print_r(file_exists('archivosUpload/logos/626310.jpg'));
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
// Output: 54esmdr0qf
echo substr(str_shuffle($permitted_chars), 0, 10) ."<br>";

print_r (explode("/","image/gif")[1])
?>