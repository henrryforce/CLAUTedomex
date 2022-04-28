<?php
   include 'conexion.php';
   class catalogos{
       function getRar_material(){
        $database = new Conexion;
        $database -> query("SELECT * from `catalogo_raw_material`");    
        $rows = $database-> resultSet();        
        return $rows;
       }
       function getProductos(){
        $database =  new Conexion;
        $database -> query("SELECT * from `catalogo_indirectos`");
        $rows = $database->resultSet();
        return $rows;
       }
       function getProceso(){
        $database =  new Conexion;    
        $database -> query("SELECT * from `catalogo_proceso`");
        $rows = $database->resultSet();
        return $rows;
       }
       function getIndrectos(){
        $database = new Conexion;
        $database -> query("SELECT * from `catalogo_indirectos`");
        $rows = $database-> resultSet();
        return $rows;
       }
   }

?>