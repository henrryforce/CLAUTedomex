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
    $obj -> query("SELECT `password`, `mail_status` FROM `usuarios` WHERE `username` = '$user'");
    $respuesta = $obj -> resultSet();
    if($respuesta === []){
        echo json_encode("Bad email");
    }
    else if(password_verify($pass, $respuesta[0]['password'])){
        if($respuesta[0]['mail_status']){
            session_start();
            $_SESSION['email'] = $user;
            echo json_encode("Correcta");
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
    $obj -> query("SELECT  `mail_status` FROM `usuarios` WHERE `username` = '$email'");
    $respuesta = $obj -> resultSet();
    if($respuesta === []){
        echo json_encode("Bad email");
    }else if($respuesta[0]['mail_status']){
        $codigo = rand(999999,111111);
        $obj -> query("UPDATE `usuarios` SET `mail_code`=$codigo  WHERE `username` = '$email'");
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
    $obj -> query("UPDATE `usuarios` SET `password`= '$hash'  WHERE `username` = '$email'");
    try{
        $obj -> resultSet();
        echo json_encode("OK");
    }catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}
?>