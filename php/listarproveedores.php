<?php

session_start();
$id=  $_SESSION['id_usuario'];
include 'Conexion.php';
if(isset($_POST['id']) && isset($_POST['getData'])){
  $idConsulta =$_POST['id'];

$obj = new Conexion();
$obj -> query("SELECT  empresa.Empresa, archivos.Logo, archivos.Presentacion, detalle_empresa.Descripcion,detalle_empresa.Pagina_web,detalle_empresa.Tel,detalle_empresa.Ext,detalle_empresa.Ventas_anuales,detalle_empresa.Num_empleados,certificacionescomprador.path, certificacionescomprador.listaCerts,exportrequeridas.paisesExporta,direccion.Calle,direccion.N_Ext,direccion.N_Int,direccion.Colonia,direccion.Alcaldia,direccion.CP, catalogo_estados.nombre as estado  FROM empresa 
INNER JOIN usuario on empresa.ID_empresa=usuario.ID_usuario 
INNER JOIN archivos ON empresa.ID_dtl_empresa=archivos.ID_archivo 
Inner Join detalle_empresa on detalle_empresa.ID_dtl_Empresa =empresa.ID_dtl_empresa
inner join direccion on detalle_empresa.ID_direccion = direccion.ID_direccion
inner join certificacionescomprador on certificacionescomprador.idComprador = usuario.ID_usuario
inner join exportrequeridas on exportrequeridas.idComprador = usuario.ID_usuario
inner join catalogo_estados on direccion.ID_estado = catalogo_estados.id
      WHERE usuario.ID_usuario=$idConsulta");
  $res= $obj -> resultSet();
echo json_encode($res);
}
if(isset($_POST['id']) && isset($_POST['getProductos'])){
    $idConsulta =$_POST['id'];
    $obj = new Conexion();
    $obj -> query("select producto.Producto, producto.ID_catalogo from producto where ID_usuario =$idConsulta order by ID_catalogo");
    $res = $obj -> resultSet();
    echo json_encode($res);
}
if(isset($_POST['id']) && isset($_POST['contactarProv'])){
  $idConsulta =$_POST['id'];
  $obj = new Conexion();
  $obj -> query("select contacto.Email from usuario inner join contacto on contacto.ID_usuario =usuario.ID_usuario where usuario.ID_usuario = $idConsulta");
  $res =$obj -> resultSet();
  //echo json_encode($res);
  //print_r($res);
  foreach($res as $email){
    echo $email['Email'];
  }

}
if(isset($_POST['tipoCat'])&& isset($_POST['getFiltar'])){
  $obj = new Conexion();
  $obj ->query("select usuario.ID_usuario as id from usuario
  inner join producto_proveedor on producto_proveedor.ID_usuario = usuario.ID_usuario
  inner join empresa on empresa.ID_empresa = usuario.ID_usuario
  where usuario.ID_usuario not in (select usuario.ID_usuario from producto_proveedor
  inner join usuario on usuario.ID_usuario = producto_proveedor.ID_usuario
  inner join empresa on empresa.ID_empresa = usuario.ID_usuario
  where ID_catalogo = ".$_POST['tipoCat'] ." and usuario.ID_tipo_usr =2) and usuario.ID_tipo_usr =2  ");
  $res = $obj ->resultSet();
  echo json_encode($res);
}
if(isset($_POST['tipoCatT'])&& isset($_POST['getFiltarT'])){
  $obj = new Conexion();
  $obj ->query("select usuario.ID_usuario as id from usuario
  inner join producto_proveedor on producto_proveedor.ID_usuario = usuario.ID_usuario
  inner join empresa on empresa.ID_empresa = usuario.ID_usuario
  where usuario.ID_usuario not in (select usuario.ID_usuario from producto_proveedor
  inner join usuario on usuario.ID_usuario = producto_proveedor.ID_usuario
  inner join empresa on empresa.ID_empresa = usuario.ID_usuario
  where ID_catalogo =".$_POST['tipoCatT'] ." and usuario.ID_tipo_usr =1) and usuario.ID_tipo_usr =1 ");
  $res = $obj ->resultSet();
  echo json_encode($res);
}
?>