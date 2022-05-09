<?php
include 'Conexion.php';
$obj = new Conexion();
    $obj -> query("call addUsersF('luis','dassdfgds',1,'sdfsdf')");
    $respuesta = $obj -> resultSet();
    print_r($respuesta);
?>