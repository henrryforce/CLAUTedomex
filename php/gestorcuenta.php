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
    
    $nameL= $_FILES['Logo']['name'];
    $namep = $_FILES['presentacion']['name'];
    $errorL = $_FILES['Logo']['error'];
    $errorp = $_FILES['presentacion']['error'];
    $tempL = $_FILES['Logo']['tmp_name'];
    $tempp = $_FILES['presentacion']['tmp_name'];
    $pathFiles = [];
    if($errorL == 4 || $errorp == 4){
        echo json_encode("Falta un arcchivo");
    }
    if($errorL == 0 && $errorp == 0){
    /**
     * Condiciones para crear y cargar los archivos
     */
    if(!file_exists('archivosUpload/logos')){
        mkdir('archivosUpload/logos',0777,true);
        if(file_exists('archivosUpload')){
            
                if(move_uploaded_file($tempL,'archivosUpload/logos/'.$nameL)){
                    array_push($pathFiles,'archivosUpload/logos/'.$nameL);
                }else{
                    array_push($pathFiles,'Upload Fail');
                }
        }
    }else{
        
        if(move_uploaded_file($tempL,'archivosUpload/logos/'.$nameL)){
            array_push($pathFiles,'archivosUpload/logos/'.$nameL);
        }else{
            array_push($pathFiles,'Upload Fail');
        }
    }
    if(!file_exists('archivosUpload/PDF')){
        mkdir('archivosUpload/PDF',0777,true);
        if(file_exists('archivosUpload')){
                if(move_uploaded_file($tempp,'archivosUpload/PDF/'.$namep)){
                    array_push($pathFiles,'archivosUpload/PDF/'.$namep);
                }else{
                    array_push($pathFiles,'Upload Fail');
                }
        }
    }else{
        
        if(move_uploaded_file($tempp,'archivosUpload/PDF/'.$namep)){
            array_push($pathFiles,'archivosUpload/PDF/'.$namep);
        }else{
            array_push($pathFiles,'Upload Fail');
        }
    }
}
    echo json_encode($pathFiles);
    }
?>