<?php
/*
include 'emailsender.php';
$obj = new enviarCorreo('luis15ago98@gmail.com','Prueba con Plantilla HTML5 con CSS 88');
echo $obj -> enviar();
*/

echo 'hola';
include 'Conexion.php';
$obj = new Conexion();
$obj -> query("SELECT * FROM `comprador`");

var_dump($obj -> resultSet());
?>