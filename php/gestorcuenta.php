<?php
session_start();
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$pdftype = 'application/pdf';
include 'Conexion.php';
if (isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['cambioPassword']) && isset($_SESSION['id_usuario'])) {
    $id = $_SESSION['id_usuario'];
    $obj = new Conexion;
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $obj->query("UPDATE `usuario` SET `contrasenia`='$hash'  WHERE `ID_usuario` = $id");
    try {
        $obj->resultSet();
        echo json_encode("OK");
    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}
if (isset($_FILES) && isset($_POST['actualizarDatos'])) {
    $id_user = $_SESSION['id_usuario'];
    $descrip = $_POST['txtnegocio'];
    $paginaweb = $_POST['paginaweb'];
    $telefono = $_POST['telefono'];
    $ext = $_POST['ext'];
    $ventas = $_POST['ventas'];
    $num_emp = $_POST['num_emp'];
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $nim_int = $_POST['nim_int'];
    $num_ext = $_POST['num_ext'];
    $cp = $_POST['cp'];
    $delegacion = $_POST['delegacion'];
    $estado = $_POST['estados'];
    $logoName = substr(str_shuffle($permitted_chars), 0, 10);
    $presenName = substr(str_shuffle($permitted_chars), 0, 10);

    $obj = new Conexion;
    $errorL = $_FILES['Logo']['error'];
    $errorp = $_FILES['presentacion']['error'];
    $tempL = $_FILES['Logo']['tmp_name'];
    $tempp = $_FILES['presentacion']['tmp_name'];
    $pathFiles = [];
    if ($errorL == 4 || $errorp == 4) {
        echo json_encode("Falta un arcchivo");
    }
    if ($errorL == 0 && $errorp == 0) {
        /**
         * Condiciones para crear y cargar los archivos
         */
        if (!file_exists('archivosUpload/logos')) {
            mkdir('archivosUpload/logos', 0777, true);
            if (file_exists('archivosUpload')) {

                if (move_uploaded_file($tempL, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1])) {
                    array_push($pathFiles, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1]);
                } else {
                    array_push($pathFiles, 'Upload Fail');
                }
            }
        } else {

            if (move_uploaded_file($tempL, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1])) {
                array_push($pathFiles, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1]);
            } else {
                array_push($pathFiles, 'Upload Fail');
            }
        }
        if (!file_exists('archivosUpload/PDF')) {
            mkdir('archivosUpload/PDF', 0777, true);
            if (file_exists('archivosUpload')) {
                if (move_uploaded_file($tempp, 'archivosUpload/PDF/' . $presenName, 0, 10) . '.' . 'pdf') {
                    array_push($pathFiles, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf');
                } else {
                    array_push($pathFiles, 'Upload Fail');
                }
            }
        } else {

            if (move_uploaded_file($tempp, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf')) {
                array_push($pathFiles, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf');
            } else {
                array_push($pathFiles, 'Upload Fail');
            }
        }
        $logo = $pathFiles[0];
        $pres = $pathFiles[1];

        $obj->query("call updateUserInfo($id_user,'$descrip','$paginaweb','$telefono',$ext,$ventas,$num_emp,'$calle','$colonia',$nim_int,$num_ext,$cp,'$delegacion',$estado,'$logo','$pres');");
        try {
            $res = $obj->resultSet();
            echo json_encode($res);
        } catch (Exception $e) {
            echo json_encode($e);
        }
    }

}
if(isset($_FILES['certdoc'])&& $_POST['cert'] == '1'){
    $certname= substr(str_shuffle($permitted_chars), 0, 10);
    $pathFileC='';
    $errorp = $_FILES['certdoc']['error'];
    $tempC = $_FILES['certdoc']['tmp_name'];
    $obj = new Conexion;
    if($_FILES['certdoc']['type'] != $pdftype){
        echo json_encode(409);
    }
    if (!file_exists('archivosUpload/Certs')) {
        mkdir('archivosUpload/Certs', 0777, true);
    }
    if(move_uploaded_file($tempC, 'archivosUpload/Certs/' . $certname . '.' . 'pdf')) {
    $pathFileC= 'archivosUpload/Certs/' . $certname . '.' . 'pdf';
    
    }
    try{
        $obj->query("INSERT INTO `certificacionescomprador`( `path`, `listaCerts`, `idcomprador`) VALUES ('$pathFileC','".$_POST['txtcerts']."',".$_SESSION['id_usuario'].")");
        $obj -> resultSet();
    }catch(Exception $e){
        echo json_encode($e);
    }
    echo json_encode(201);
}
