<?php

session_start();
$id=  $_SESSION['id_usuario'];
if(isset($_POST['id']) && isset($_POST['getData'])){
  $id =$_POST['id'];
include 'Conexion.php';
$obj = new Conexion();
$obj -> query("SELECT  empresa.Empresa, archivos.Logo, archivos.Presentacion, detalle_empresa.Descripcion,detalle_empresa.Pagina_web,detalle_empresa.Tel,detalle_empresa.Ext,detalle_empresa.Ventas_anuales,detalle_empresa.Num_empleados,certificacionescomprador.path, certificacionescomprador.listaCerts,exportrequeridas.paisesExporta,direccion.Calle,direccion.N_Ext,direccion.N_Int,direccion.Colonia,direccion.Alcaldia,direccion.CP, catalogo_estados.nombre as estado  FROM empresa 
INNER JOIN usuario on empresa.ID_empresa=usuario.ID_usuario 
INNER JOIN archivos ON empresa.ID_dtl_empresa=archivos.ID_archivo 
Inner Join detalle_empresa on detalle_empresa.ID_dtl_Empresa =empresa.ID_dtl_empresa
inner join direccion on detalle_empresa.ID_direccion = direccion.ID_direccion
inner join certificacionescomprador on certificacionescomprador.idComprador = usuario.ID_usuario
inner join exportrequeridas on exportrequeridas.idComprador = usuario.ID_usuario
inner join catalogo_estados on direccion.ID_estado = catalogo_estados.id
      WHERE usuario.ID_usuario=$id");
  $res= $obj -> resultSet();
echo json_encode($res);
}
?>