<?php
include '../php/emailsender.php';
if(isset($_POST['name']) && isset($_POST['email'])&&isset($_POST['phone'])&&isset($_POST['subject'])&&isset($_POST['message'])){
    $mail = new enviarCorreo("self",'Solicitud de Contacto');
    try{
        $mail ->correoContacto($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['subject'],$_POST['message']);
        echo json_encode("send");
    }catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
}
?>