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
    $obj->query("call GetIDs($id_user);");
    $databaseA = $obj->resultSet();
    $obj->query("SELECT `Logo`, `Presentacion` FROM `archivos` WHERE `ID_archivo` = " . $databaseA[0]['id_archivo'] . "");
    $filesExis = $obj->resultSet();
    $logo = null;
    $pres = null;
    /**se crea el directorio de logos si no existe */
    if (!file_exists('archivosUpload/logos')) {
        mkdir('archivosUpload/logos', 0777, true);
    }
    /**Se crea el directorio de PDFs si no existe */
    if (!file_exists('archivosUpload/PDF')) {
        mkdir('archivosUpload/PDF', 0777, true);
    }
    /**Con estas condiciones podemos cargar de forma independiente los logos y las presentaciones aunque son necesarias para poder subir los servicios ofertados */
    /**si no mandas un Logo pero existe en la bd se sobre escribe el path existente, en caso de que envien un pdf se pushea el path en el array*/
    if ($errorL == 4 && file_exists($filesExis[0]['Logo'])) {
        $logo = $filesExis[0]['Logo'];
        array_push($pathFiles, $filesExis[0]['Logo']);
    }
    /**en caso de que cargues un PDF pero existe uno en la bd se sobreescribe el path */
    if ($errorp == 4 && file_exists($filesExis[0]['Presentacion'])) {
        $pres = $filesExis[0]['Presentacion'];
    }
    /**en caso de que no mandes nada y no haya nada en la bd se asigna null y se pushea algo al array por si enviaron un PDF */
    if ($errorL == 4 && !file_exists($filesExis[0]['Logo'])) {
        $logo = null;
        array_push($pathFiles, 'undefinided');
    }
    /**en caso de que no mandes pdf ni haya uno en la BD se asigna null */
    if ($errorp == 4 && !file_exists($filesExis[0]['Presentacion'])) {
        $pres = null;
    }
    /**Si mandas un Logo pero ya existia uno en la BD se borra primero el anterior y despues se sube el nuevo y se asigna al array de paths para enviarlo a la consulta*/
    if ($errorL == 0 && file_exists($filesExis[0]['Logo'])) {
        unlink($filesExis[0]['Logo']);
        if (move_uploaded_file($tempL, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1])) {
            array_push($pathFiles, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1]);
        } else {
            array_push($pathFiles, 'Upload Fail');
        }
        $logo = $pathFiles[0];
    }
    /**Si mandas un PDF y ya existia uno en la BD, primero se elimina el anterior y despues se carga el nuevo y se asigba al array de paths para enviarlo a la consulta */
    if ($errorp == 0 && file_exists($filesExis[0]['Presentacion'])) {
        unlink($filesExis[0]['Presentacion']);
        if (move_uploaded_file($tempp, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf')) {
            array_push($pathFiles, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf');
        } else {
            array_push($pathFiles, 'Upload Fail');
        }
        $pres = $pathFiles[1];
    }
    /**En caso de que mandes un Logo pero no existe nada en la BD se carga el nuevo y se asigna al array de paths sin eliminar nada */
    if($errorL == 0 && !file_exists($filesExis[0]['Logo'])){
        if (move_uploaded_file($tempL, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1])) {
            array_push($pathFiles, 'archivosUpload/logos/' . $logoName . '.' . explode("/", $_FILES['Logo']['type'])[1]);
        } else {
            array_push($pathFiles, 'Upload Fail');
        }
        $logo = $pathFiles[0];
    }
    /**en caso de que mandes un PDF y no exista uno en la BD se carga el nuevo y se asigna al array de paths */
    if ($errorp == 0 && !file_exists($filesExis[0]['Presentacion'])) {
        if (move_uploaded_file($tempp, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf')) {
            array_push($pathFiles, 'archivosUpload/PDF/' . $presenName . '.' . 'pdf');
        } else {
            array_push($pathFiles, 'Upload Fail');
        }
        $pres = $pathFiles[1];
    }
    /**Consulta SQL actualiza los datos devuelve un 201 si todo se cargo correctamente */
    $obj->query("call updateUserInfo($id_user,'$descrip','$paginaweb','$telefono',$ext,$ventas,$num_emp,'$calle','$colonia',$nim_int,$num_ext,$cp,'$delegacion',$estado,'$logo','$pres');");
    try {
        $obj->resultSet();
        echo json_encode(201);
    } catch (Exception $e) {
        echo json_encode($e);
    }

}
if (isset($_FILES['certdoc']) && $_POST['cert'] == '1') {
    $certname = substr(str_shuffle($permitted_chars), 0, 10);
    $pathFileC = '';
    $errorp = $_FILES['certdoc']['error'];
    $tempC = $_FILES['certdoc']['tmp_name'];
    $obj = new Conexion;
    $obj->query("SELECT  `path` FROM `certificacionescomprador` WHERE `idcomprador` = " . $_SESSION['id_usuario'] . "");
    $archExis = $obj->resultSet();

    if ($archExis[0]['path'] != null || $archExis[0]['path'] != '') {
        unlink($archExis[0]['path']);
    }
    if ($_FILES['certdoc']['type'] != $pdftype) {
        echo json_encode(409);
    }
    if (!file_exists('archivosUpload/Certs')) {
        mkdir('archivosUpload/Certs', 0777, true);
    }
    if (move_uploaded_file($tempC, 'archivosUpload/Certs/' . $certname . '.' . 'pdf')) {
        $pathFileC = 'archivosUpload/Certs/' . $certname . '.' . 'pdf';
    }

    try {
        $obj->query("UPDATE `certificacionescomprador` SET `path`='$pathFileC',`listaCerts`='" . $_POST['txtcerts'] . "' WHERE `idcomprador` = " . $_SESSION['id_usuario'] . "");
        $obj->resultSet();
    } catch (Exception $e) {
        echo json_encode($e);
    }
    echo json_encode(201);
}
if (isset($_POST['paises'])) {
    $paises = $_POST['paises'];
    $paises = str_replace('"', '', str_replace(']', '', str_replace('[', '', $paises)));
    $id = $_SESSION['id_usuario'];
    $obj = new Conexion;
    $obj->query("SELECT `idexportaciones` FROM `exportrequeridas` WHERE `idcomprador` = $id");
    $res = $obj->resultSet();
    if ($res != []) {
        $obj->query("UPDATE `exportrequeridas` SET`paisesExporta`='$paises' WHERE `idcomprador`=$id");
    } else {
        $obj->query("INSERT INTO `exportrequeridas`( `idcomprador`, `paisesExporta`) VALUES ($id,'$paises')");
    }

    try {
        //code...
        $res = $obj->resultSet();
    } catch (Exception $e) {
        //throw $th;
        echo json_encode($e);
    }
    echo json_encode(201);

  
}
if(isset($_GET['expo'])&& $_GET['expo'] ==501){
    $obj = new Conexion;
    $id = $_SESSION['id_usuario'];
$obj->query("SELECT `paisesExporta` as pais FROM `exportrequeridas` WHERE `idcomprador` =$id");
$res = $obj->resultSet();
echo json_encode($res);
}
if(isset($_POST['logout'])){
    session_destroy();
}
