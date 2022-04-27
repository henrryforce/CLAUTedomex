<?php
/**
 * Variables post de login creadas y validacion de su existencia y validacion de cadenas vacias
 */
include 'Conexion.php';
$user = $_POST['email'];
$pass = $_POST['password'];
if(isset($user) && isset($pass)){
    if($user =='' || $pass === ''){
        echo json_encode("Datos incompletos");
    }else{
        $obj = new Conexion();
        $obj -> query("SELECT * FROM `comprador`");
        echo json_encode($obj -> resultSet());
    }
    
}
else{
    echo json_encode("No hay datos");
}
?>