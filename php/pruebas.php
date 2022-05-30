<?php

session_start();
$id=  $_SESSION['id_usuario'];
if(isset($_POST['id']) && isset($_POST['getData'])){
  $id =$_POST['id'];
include 'Conexion.php';
$obj = new Conexion();
$obj -> query("SELECT archivos.Presentacion FROM empresa 
INNER JOIN usuario on empresa.ID_empresa=usuario.ID_usuario 
INNER JOIN archivos ON empresa.ID_dtl_empresa=archivos.ID_archivo
WHERE ID_usuario=$id");
  $res= $obj -> resultSet();
echo json_encode($res);
}
?>