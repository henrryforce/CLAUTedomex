<?php
    include 'conexion.php';

    $database = new Conexion;

    $database -> query("SELECT * from `catalogo_indirectos`");

    $rows = $database-> resultSet();

    
    print_r(($rows));    
?>