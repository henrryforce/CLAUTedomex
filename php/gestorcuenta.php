<?php
session_start();
include 'Conexion.php';
if(isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['cambioPassword']) && isset($_SESSION['id_usuario'])){
    $id = $_SESSION['id_usuario'];
    $obj = new Conexion;
    $hash = password_hash($_POST['password'],PASSWORD_BCRYPT);
    $obj-> query("UPDATE `usuario` SET `contrasenia`='$hash'  WHERE `ID_usuario` = $id");
    try{
        $obj -> resultSet();
        echo json_encode("OK");
    }catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
  }
  if(isset($_FILES) && isset($_POST['actualizarDatos'])){
      print_r($_FILES);
  }else{
      echo json_encode("No hay archivo");
  }
?>