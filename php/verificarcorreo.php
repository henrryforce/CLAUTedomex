<?php
include 'Conexion.php';
$email = $_POST['email'];
$codigo = $_POST['codigo'];
if(isset($codigo)){
    $obj = new Conexion();
    $obj -> query("SELECT `mail_code` FROM `usuarios` WHERE `username` = '$email'");
    $respuesta = $obj -> resultSet();
    if($respuesta == []){
        
        echo json_encode("No se encontro el correo");
    }else{
        echo json_encode($respuesta);
    }
}?>