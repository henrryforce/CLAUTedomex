<?php

session_start();
$id=  $_SESSION['id_usuario'];
include '../php/emailsender.php';
if(isset($_POST['id']) && isset($_POST['contactarProv'])){
  $idConsulta =$_POST['id'];
include 'Conexion.php';
$obj = new Conexion();
$emailCC = [];
//$contactosT= [];
$table ='';
$obj -> query("select empresa.Empresa,usuario.usuario, contacto.nombre,contacto.Email,contacto.Tel,contacto.Ext,contacto.Cel from empresa
inner join usuario on usuario.ID_empresa = empresa.ID_empresa
inner join contacto on contacto.ID_usuario = usuario.ID_usuario
where usuario.ID_usuario = $id");
  $datosTractora= $obj -> resultSet();
  $obj -> query("select empresa.Empresa,usuario.usuario, contacto.nombre,contacto.Email from empresa
  inner join usuario on usuario.ID_empresa = empresa.ID_empresa
  inner join contacto on contacto.ID_usuario = usuario.ID_usuario
  where usuario.ID_usuario =  $idConsulta");
  $datosProveedor= $obj -> resultSet();
   
  foreach($datosProveedor as $datos){
    array_push($emailCC,[$datos['Email'],$datos['nombre']]);
  }
  foreach($datosTractora as $contacto){
    $table .="
    <tr>
    <td>".$contacto['nombre']."</td>
    <td>".$contacto['Email']."</td>
    <td>".strval($contacto['Tel'])."</td>
    <td>".strval($contacto['Ext'])."</td>
    <td>".strval($contacto['Cel'])."</td>                    
  </tr>
    ";
  }
  

    $mail = new enviarCorreo('luis15ago98@gmail.com','Contacto tractora a proveedor');
    try{
      $mail -> mailTtoP($datosTractora[0]['Empresa'],$datosProveedor[0]['Empresa'],$datosTractora[0]['usuario'],$datosProveedor[0]['usuario'],$table,$emailCC);
    }catch(Exception $e){
      return $e;
    }
    echo json_encode(201);
}
?>