<?php
/**
 * Variables post de login creadas y validacion de su existencia y validacion de cadenas vacias
 */
include 'Conexion.php';
include '../php/emailsender.php';
/**
 * Proceso de verifiacar email y contraseña para el inicio de sesion
 */
if(isset($_POST['email']) && isset($_POST['password']) && !isset($_POST['resetPass'])){
    $user = $_POST['email'];
    $pass = $_POST['password'];
    $obj = new Conexion();
    $obj -> query("SELECT `contrasenia`, `Estatus_mail`, `ID_usuario`,`ID_tipo_usr` FROM `usuario` WHERE `usuario` = '$user'");
    $respuesta = $obj -> resultSet();
    if($respuesta === []){
        echo json_encode("Bad email");
    }
    else if(password_verify($pass, $respuesta[0]['contrasenia'])){
        if($respuesta[0]['Estatus_mail']){
            session_start();
            $_SESSION['email'] = $user;
            $_SESSION['id_usuario'] = $respuesta[0]['ID_usuario'];
            echo json_encode($respuesta[0]['ID_tipo_usr']);
            
        }else{
            echo json_encode("Sin Verificar");
        }
        
    }else{
        echo json_encode("Incorrecta");
    }
}
/**
 * Proceso de reestablecer la contraseña generando nuevo codigo y enviando lo por correo
 */
if(isset($_POST['email'])&&isset($_POST['restablecer'])){
    $email = $_POST['email'];
    $obj = new Conexion();
    $obj -> query("SELECT  `Estatus_mail` FROM `usuario` WHERE `usuario` = '$email'");
    $respuesta = $obj -> resultSet();
    if($respuesta === []){
        echo json_encode("Bad email");
    }else if($respuesta[0]['Estatus_mail']){
        $codigo = rand(999999,111111);
        $obj -> query("UPDATE `usuario` SET `Codigo_verificacion`=$codigo  WHERE `usuario` = '$email'");
        try{
            $obj -> resultSet();
            $mail = new enviarCorreo($email,'Codigo de verificación');
            $mail -> sendCode($codigo);
            session_start();
            $_SESSION['email']= $email;
            echo json_encode("OK");
        }catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }else{
        echo json_encode("Sin Verificar");
    }
}
/**
 * Actualizando la contrasena con un nuevo pass
 */
if(isset($_POST['password'])&&isset($_POST['password_c'])&&isset($_POST['email'])&&isset($_POST['resetPass'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $hash = password_hash($pass,PASSWORD_BCRYPT);
    $obj = new Conexion();
    $obj -> query("UPDATE `usuario` SET `contrasenia`= '$hash'  WHERE `usuario` = '$email'");
    try{
        $obj -> resultSet();
        echo json_encode("OK");
    }catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}
?>