<?php
include 'Conexion.php';
include '../php/emailsender.php';
if(isset($_POST['nom_empresa']) && isset($_POST['usertype'])&&isset($_POST['email'])&&isset($_POST['password'])){
    $nom_empresa=$_POST['nom_empresa'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $pass_confirm =$_POST['password_confirm'];
    
    
        $obj = new Conexion();
        $obj -> query("SELECT * FROM `usuario` WHERE `usuario` = '$email'");
        $respuesta = $obj -> resultSet();
        if(count($respuesta)>0){
            echo json_encode("El correo ya existe");
        }else{
            if($_POST['usertype'] === 'Tractora'){
                $usertype=1;
            }else if($_POST['usertype'] === 'Proveedor'){
                $usertype=2;
            }
            $codigo = rand(999999,111111);
            $hash = password_hash($pass,PASSWORD_BCRYPT);
            $obj -> query("call addUsersF('$email','$hash',$usertype,'$nom_empresa',$codigo);");
            $respuesta = $obj -> resultSet();
            if($respuesta != []){
                $obj = new enviarCorreo($email,'Codigo de verificación');
                $obj -> sendCode($codigo);
                echo json_encode("Registrado Correctamente");
            }else{
                echo json_encode($respuesta);
            }
        } 
}

if(isset($_POST['email'])&&isset($_POST['codigo'])){
    $email = $_POST['email'];
    $codigo = $_POST['codigo'];
    if(isset($codigo)){
        $obj = new Conexion();
        $obj -> query("SELECT `Codigo_verificacion` FROM `usuario` WHERE `usuario` = '$email'");
        $respuesta = $obj -> resultSet();
        if($respuesta == []){
            
            echo json_encode("No se encontro el correo");
        }else{
            if($codigo !== $respuesta[0]["Codigo_verificacion"]){
                echo json_encode("Codigo erroneo");
            }else{
                $obj -> query("UPDATE `usuario` SET `Estatus_mail`= 1 WHERE `usuario` = '$email'");
                $obj -> resultSet();
                echo json_encode("Codigo correcto");
            }
            
        }
    }
}
if(isset($_POST['email'])&& isset($_POST['reenvio'])){
    $email = $_POST['email'];
    $obj = new Conexion();
    $obj -> query("SELECT `Codigo_verificacion` FROM `usuario` WHERE `usuario` = '$email'");
    $respuesta = $obj -> resultSet();
    try{
        $mail = new enviarCorreo($email,'Codigo de verificación');
        $mail -> sendCode($respuesta[0]["Codigo_verificacion"]);
        echo json_encode("enviado");
    }catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}
?>