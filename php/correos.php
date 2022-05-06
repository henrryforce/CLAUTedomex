<?php
include '../php/emailsender.php';
$obj = new enviarCorreo('luis15ago98@gmail.com','Codigo de verificación');
echo $obj -> sendCode('123458');
?>