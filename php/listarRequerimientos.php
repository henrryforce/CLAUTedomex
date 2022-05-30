<?php
    require_once "Conexion.php";
    $database = new Conexion;

    $t_empresa ='';
    $t_tel = '';
    $t_ext ='';
    $t_sitio= '';
    $t_calle = '';
    $t_colonia = '';
    $t_ciudad = '';
    $t_edo = '';
    $t_cp ='';
    $t_ventas = '';
    $t_nE = '';
    $t_des = '';


    if(isset($_POST['btnVer'])){
        $database->query("SELECT usuario.ID_usuario, usuario.ID_empresa, empresa.ID_empresa, empresa.Empresa, 
                        producto.Producto, producto.ID_catalogo, detalle_empresa.Tel, detalle_empresa.Ext, detalle_empresa.Pagina_web, 
                        detalle_empresa.Ventas_anuales, detalle_empresa.Num_empleados, detalle_empresa.Descripcion, direccion.Calle, 
                        direccion.Colonia, direccion.CP, direccion.Alcaldia, catalogo_estados.nombre as Estado
                        FROM usuario
                        INNER JOIN empresa ON usuario.ID_usuario = empresa.ID_empresa
                        INNER JOIN producto ON usuario.ID_usuario = producto.ID_producto
                        INNER JOIN detalle_empresa ON usuario.ID_empresa = detalle_empresa.ID_dtl_empresa
                        INNER JOIN direccion ON usuario.ID_empresa = direccion.ID_direccion
                        INNER JOIN catalogo_estados ON usuario.ID_empresa = catalogo_estados.id
                        WHERE producto.ID_catalogo='2' AND usuario.ID_usuario='2'");

        $rows = $database->resultSet();
        foreach($rows as $row){
            $t_tel = $row['Tel'];
            $t_ext =$row['Ext'];
            $t_sitio= $row['Pagina_web'];
            $t_calle = $row['Calle'];
            $_colonia = $row['Colonia'];
            $t_ciudad = $row['Alcaldia'];
            $t_edo = $row['Estado'];
            $t_cp =$row['CP'];
            $t_ventas = $row['Ventas_anuales'];
            $t_nE = $row['Num_empleados'];
            $t_des = $row['Descipcion'];
        }
    }
?>