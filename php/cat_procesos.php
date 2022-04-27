<?php
    require("Conexion.php");
    
    $database =  new Conexion;    
    
    $database -> query("SELECT * from `catalogo_proceso`");
    
    $rows = $database->resultSet();
    
    echo(json_encode($rows));
?>