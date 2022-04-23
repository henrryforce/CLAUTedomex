<?php
$user = $_POST['email'];
$pass = $_POST['password'];
if(isset($user) && isset($pass)){
    if($user =='' || $pass === ''){
        echo json_encode("Datos incompletos");
    }else{
        echo json_encode("Datos Recibidos");
    }
    
}
else{
    echo json_encode("No hay datos");
}
?>