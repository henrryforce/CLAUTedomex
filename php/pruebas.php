<?php

session_start();
$id=  $_SESSION['id_usuario'];
include 'Conexion.php';
$obj = new Conexion();
//session_destroy();

echo $id;

?>