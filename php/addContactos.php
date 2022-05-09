<?php

    require_once "Conexion.php";    
    $database = new Conexion;
    
    $update = false;
    $id_cont='';
    $name = '';
    $job = '';
    $mail = '';
    $tele= '';
    $exte='';
    $cel= '';
    
    if(isset($_POST['btnadd'])){

        $nombre = isset($_POST['txt_nombre']) ? $_POST['txt_nombre'] : '';
        $puesto = isset($_POST['txt_puesto']) ? $_POST['txt_puesto'] : '';
        $email = isset($_POST['txt_mail']) ? $_POST['txt_mail'] : '';
        $tel = isset($_POST['txt_tel']) ? $_POST['txt_tel'] : '';
        $ext = isset($_POST['txt_ext']) ? $_POST['txt_ext'] : '';
        $cel = isset($_POST['txt_cel']) ? $_POST['txt_cel'] : '';    
        $id_user = $_COOKIE['user_id'];        
        
        $database->query("INSERT INTO contacto(nombre, puesto, email, tel, ext, cel, ID_usuario) VALUES (?,?,?,?,?,?,?) ");
        $database->bind(1, $nombre);
        $database->bind(2, $puesto);
        $database->bind(3, $email);
        $database->bind(4, $tel);
        $database->bind(5, $ext);
        $database->bind(6, $cel);
        $database->bind(7, $id_user);
        $database->execute();

        header("location: /CLAUTedomex/PaginaprincipalDeProveedores.php");
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $database->query("DELETE FROM `contacto` WHERE `contacto`.`ID_contacto` = $id");
        $database->resultSet();

        header("location: /CLAUTedomex/PaginaprincipalDeProveedores.php");
    }

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

    if(isset($_POST['update'])){
        $id_cont = $_POST['ed_id'] ? $_POST['ed_id']:'';
        $name = $_POST['ed_name'] ? $_POST['ed_name']: '';            
        $job = $_POST['ed_job'] ? $_POST['ed_job']: '';
        $mail = $_POST['ed_mail'] ? $_POST['ed_mail']: '';
        $tele= $_POST['ed_tel'] ? $_POST['ed_tel']: '';
        $exte= $_POST['ed_ext'] ? $_POST['ed_ext']: '';
        $cel= $_POST['ed_cel'] ? $_POST['ed_cel']: ''; 
        
        $database->query("UPDATE `contacto` SET `Nombre` =?, `Puesto` = ?, `Email` = ?, `Tel` = ?, `Ext` = ?, `Cel` = ? WHERE `contacto`.`ID_contacto` = ?");
        $database->bind(1, $name);
        $database->bind(2, $job);
        $database->bind(3, $mail);
        $database->bind(4, $tele);
        $database->bind(5, $exte);
        $database->bind(6, $cel);
        $database->bind(7, $id_cont);
        $database->execute();
        
        header("location: /CLAUTedomex/PaginaprincipalDeProveedores.php");
    }
?>