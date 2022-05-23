<?php

session_start();
$id=  $_SESSION['id_usuario'];
include 'Conexion.php';
$obj = new Conexion();
//session_destroy();

$obj -> query("SELECT  `Logo` FROM `archivos` WHERE `ID_archivo` = 12");
$res= $obj -> resultSet();
print_r($res);
echo ('<br>');
echo ($res[0]['Logo'] =='' ) ? 'php/archivosUpload/logos/default.png': $res[0]['Logo'];

?>