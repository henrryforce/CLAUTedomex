<?php
include '../php/emailsender.php';
$mail = new enviarCorreo('luis15ago98@gmail.com','Codigo de verificación');
$mail -> enviar();
?>