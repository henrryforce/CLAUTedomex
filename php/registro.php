<?php
include 'Conexion.php';
include '../php/emailsender.php';
if(isset($_POST['nom_empresa']) && isset($_POST['usertype'])&&isset($_POST['email'])&&isset($_POST['password'])){
    $nom_empresa=$_POST['nom_empresa'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_confirm =$_POST['password_confirm'];
    $usertype =$_POST['usertype'];
    if(isset($email)&& isset($nom_empresa) && isset($pass)&& isset($pass_confirm)&& isset($usertype)){
        $obj = new Conexion();
        $obj -> query("SELECT * FROM `usuarios` WHERE `username` = '$email'");
        $respuesta = $obj -> resultSet();
        if(count($respuesta)>0){
            echo json_encode("El correo ya existe");
        }else{
            $codigo = rand(999999,111111);
            $hash = password_hash($pass,PASSWORD_BCRYPT);
            $obj -> query("INSERT INTO `usuarios`(`username`, `password`, `mail_code`) VALUES ('$email','$hash','$codigo')");
            $respuesta = $obj -> resultSet();
            if($respuesta == []){
                $obj = new enviarCorreo($email,'Codigo de verificación');
                $obj -> sendCode($codigo);
                echo json_encode("Registrado Correctamente");
            }else{
                echo json_encode($respuesta);
            }
        } 
}else{
  echo json_encode("No hay datos" );
}
}
if(isset($_POST['email'])&&isset($_POST['codigo'])){
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
    }
}
?>