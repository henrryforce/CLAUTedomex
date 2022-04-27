<?php
    include 'conexion.php';

    $database = new Conexion;

    $database -> query("SELECT * from `catalogo_raw_material`");

    $rows = $database-> resultSet();
    
    echo(json_encode($rows));
    
?>