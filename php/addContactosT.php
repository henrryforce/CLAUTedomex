<?php
    
    require_once "Conexion.php";    
    $database = new Conexion;
    //Creacion de las variables para la tabla Editar contacto
    $update = false;
    $id_cont_t ='';
    $name_t = '';
    $job_t = '';
    $mail_t = '';
    $tele_t= '';
    $exte_t='';
    $cel_t= '';
    
    //Validacion para Insertar datos en la tabla Contacto 
    if(isset($_POST['btnaddC'])){

        $nombre_t = isset($_POST['tr_nombre']) ? $_POST['tr_nombre'] : '';//Creacion de las variables en donde
        $puesto_t = isset($_POST['tr_puesto']) ? $_POST['tr_nombre'] : '';//se van a obtener los datos ingrsados de los 
        $email_t = isset($_POST['tr_mail']) ? $_POST['tr_mail'] : '';     //input del formulario PaginaPrincipaldeProveedores
        $tel_t = isset($_POST['tr_tel']) ? $_POST['tr_tel'] : '';
        $ext_t = isset($_POST['tr_ext']) ? $_POST['tr_ext'] : '';
        $cel_t = isset($_POST['tr_cel']) ? $_POST['tr_cel'] : '';
        $direccion_t = isset($_POST['tr_val']) ? $_POST['tr_val'] : '';
        $id_user_t = isset($_POST['tr_usr']) ? $_POST['tr_usr'] : '';
        
        echo ($id_user_t);
        $_SESSION['message'] = "¡Se ha agregado con éxito el contacto!";
        $_SESSION['msg_type'] = "success";

        $database->query("INSERT INTO contacto(nombre, puesto, email, tel, ext, cel, ID_usuario) VALUES (?,?,?,?,?,?,?) ");
        $database->bind(1, $nombre_t);
        $database->bind(2, $puesto_t);
        $database->bind(3, $email_t);
        $database->bind(4, $tel_t);
        $database->bind(5, $ext_t);
        $database->bind(6, $cel_t);
        $database->bind(7, $id_user_t);
        $database->execute();                
        
        header("location: ../PaginaprincipalDeTractoras.php");        
    }
    //Validacion para poder eliminar un contacto
    if(isset($_GET['deletet'])){
        $id = $_GET['deletet'];
        $_SESSION['message'] = "¡Se ha eliminado con éxito el contacto!";
        $_SESSION['msg_type'] = "danger";

        $database->query("DELETE FROM `contacto` WHERE `contacto`.`ID_contacto` = $id");
        $database->resultSet();
                            
        header("location: ../PaginaprincipalDeTractoras.php");
        
    }
    //Validacion para poder enviar los datos que se quieran modificar a la tabla Editar contacto
    if(isset($_GET['editt'])){
        $id = $_GET['editt'];
        $database->query("SELECT * FROM contacto WHERE ID_contacto = $id");
        $rows = $database->resultSet();        
        $update = true;

        foreach ($rows as $row ) :
            $id_cont_t = $row['ID_contacto'];           
            $name_t = $row['Nombre'];            
            $job_t = $row['Puesto'];
            $mail_t = $row['Email'];
            $tele_t= $row['Tel'];
            $exte_t= $row['Ext'];
            $cel_t= $row['Cel'];
        endforeach;        
    }
    //Validacion para modificar los datos de la tabla Contacto
    if(isset($_POST['update'])){
        $id_cont_t = $_POST['ed_id'] ? $_POST['ed_id']:'';    //Se obtienen las variables que contienen la nueva informacion 
        $name_t = $_POST['ed_name'] ? $_POST['ed_name']: '';  //que se desea actualizar en la tabla
        $job_t = $_POST['ed_job'] ? $_POST['ed_job']: '';     //contacto.
        $mail_t = $_POST['ed_mail'] ? $_POST['ed_mail']: '';
        $tele_t= $_POST['ed_tel'] ? $_POST['ed_tel']: '';
        $exte_t= $_POST['ed_ext'] ? $_POST['ed_ext']: '';
        $cel_t= $_POST['ed_cel'] ? $_POST['ed_cel']: ''; 
        
        $_SESSION['message'] = "¡Se ha modificado con éxito el contacto!";
        $_SESSION['msg_type'] = "warning";

        $database->query("UPDATE `contacto` SET `Nombre` =?, `Puesto` = ?, `Email` = ?, `Tel` = ?, `Ext` = ?, `Cel` = ? WHERE `contacto`.`ID_contacto` = ?");
        $database->bind(1, $name_t);
        $database->bind(2, $job_t);
        $database->bind(3, $mail_t);
        $database->bind(4, $tele_t);
        $database->bind(5, $exte_t);
        $database->bind(6, $cel_t);
        $database->bind(7, $id_cont_t);
        $database->execute();
        
        header("location: /PaginaprincipalDeTractoras.php");
    }
?>