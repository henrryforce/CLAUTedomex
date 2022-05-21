<?php

session_start();
$id=  $_SESSION['id_usuario'];
include 'Conexion.php';
$obj = new Conexion();
//session_destroy();

$obj -> query("SELECT  `paisesExporta` as pais FROM `exportrequeridas` WHERE `idcomprador` = $id");
$res= $obj -> resultSet();
if(isset($_GET['expo']) && $_GET['expo'] == 501 ){
    echo json_encode($res);
}

?>