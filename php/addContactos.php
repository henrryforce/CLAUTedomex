<?php
    
    require_once "Conexion.php";    
    $database = new Conexion;
    //Creacion de las variables para la tabla Editar contacto
    $update = false;
    $id_cont='';
    $name = '';
    $job = '';
    $mail = '';
    $tele= '';
    $exte='';
    $cel= '';
    
    //Validacion para Insertar datos en la tabla Contacto 
    if(isset($_POST['btnadd'])){

        $nombre = isset($_POST['txt_nombre']) ? $_POST['txt_nombre'] : '';//Creacion de las variables en donde
        $puesto = isset($_POST['txt_puesto']) ? $_POST['txt_puesto'] : '';//se van a obtener los datos ingrsados de los 
        $email = isset($_POST['txt_mail']) ? $_POST['txt_mail'] : '';     //input del formulario PaginaPrincipaldeProveedores
        $tel = isset($_POST['txt_tel']) ? $_POST['txt_tel'] : '';
        $ext = isset($_POST['txt_ext']) ? $_POST['txt_ext'] : '';
        $cel = isset($_POST['txt_cel']) ? $_POST['txt_cel'] : '';
        $direccion = isset($_POST['txt_val']) ? $_POST['txt_val'] : '';
        $id_user = isset($_POST['txt_usr']) ? $_POST['txt_usr'] : '';
        
        echo ($id_user);
        $_SESSION['message'] = "¡Se ha agregado con éxito el contacto!";
        $_SESSION['msg_type'] = "success";

        $database->query("INSERT INTO contacto(nombre, puesto, email, tel, ext, cel, ID_usuario) VALUES (?,?,?,?,?,?,?) ");
        $database->bind(1, $nombre);
        $database->bind(2, $puesto);
        $database->bind(3, $email);
        $database->bind(4, $tel);
        $database->bind(5, $ext);
        $database->bind(6, $cel);
        $database->bind(7, $id_user);
        $database->execute();
        if($direccion=='1'){
            header("location: ../PaginaprincipalDeProveedores.php");
        }else{
            header("location: ../PaginaprincipalDeTractoras.php");
        }
    }
    //Validacion para poder eliminar un contacto
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $_SESSION['message'] = "¡Se ha eliminado con éxito el contacto!";
        $_SESSION['msg_type'] = "danger";

        $database->query("DELETE FROM `contacto` WHERE `contacto`.`ID_contacto` = $id");
        $database->resultSet();

        header("location: /PaginaprincipalDeProveedores.php");
    }
    //Validacion para poder enviar los datos que se quieran modificar a la tabla Editar contacto
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $database->query("SELECT * FROM contacto WHERE ID_contacto = $id");
        $rows = $database->resultSet();        
        $update = true;

        foreach ($rows as $row ) :
            $id_cont= $row['ID_contacto'];           
            $name = $row['Nombre'];            
            $job = $row['Puesto'];
            $mail = $row['Email'];
            $tele= $row['Tel'];
            $exte= $row['Ext'];
            $cel= $row['Cel'];
        endforeach;        
    }
    //Validacion para modificar los datos de la tabla Contacto
    if(isset($_POST['update'])){
        $id_cont = $_POST['ed_id'] ? $_POST['ed_id']:'';    //Se obtienen las variables que contienen la nueva informacion 
        $name = $_POST['ed_name'] ? $_POST['ed_name']: '';  //que se desea actualizar en la tabla
        $job = $_POST['ed_job'] ? $_POST['ed_job']: '';     //contacto.
        $mail = $_POST['ed_mail'] ? $_POST['ed_mail']: '';
        $tele= $_POST['ed_tel'] ? $_POST['ed_tel']: '';
        $exte= $_POST['ed_ext'] ? $_POST['ed_ext']: '';
        $cel= $_POST['ed_cel'] ? $_POST['ed_cel']: ''; 
        
        $_SESSION['message'] = "¡Se ha modificado con éxito el contacto!";
        $_SESSION['msg_type'] = "warning";

        $database->query("UPDATE `contacto` SET `Nombre` =?, `Puesto` = ?, `Email` = ?, `Tel` = ?, `Ext` = ?, `Cel` = ? WHERE `contacto`.`ID_contacto` = ?");
        $database->bind(1, $name);
        $database->bind(2, $job);
        $database->bind(3, $mail);
        $database->bind(4, $tele);
        $database->bind(5, $exte);
        $database->bind(6, $cel);
        $database->bind(7, $id_cont);
        $database->execute();
        
        header("location: /PaginaprincipalDeProveedores.php");
    }
?>