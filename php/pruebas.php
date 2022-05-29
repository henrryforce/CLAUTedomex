<?php

session_start();
$id=  $_SESSION['id_usuario'];
include 'Conexion.php';
$obj = new Conexion();
$obj -> query("SELECT  `Logo` FROM `archivos` WHERE `ID_archivo` = $id");
  $res= $obj -> resultSet();
echo isset($res[0]['Logo']);

?>