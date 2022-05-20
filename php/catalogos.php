<?php
   include 'conexion.php';
   $obj = new Conexion;
if (isset($_POST['tipo']) && $_POST['tipo'] == '1') {
    $obj->query("SELECT idproducto as id,producto FROM catalogo_productos");
    $res = $obj->resultSet();
    echo json_encode($res);
}
if (isset($_POST['tipo']) && $_POST['tipo'] == '2') {
    $obj->query("SELECT id_catPros as id,producto  FROM catalogo_proceso");
    $res = $obj->resultSet();
    echo json_encode($res);
}
if (isset($_POST['tipo']) && $_POST['tipo'] == '3') {
    $obj->query("SELECT id, producto FROM catalogo_raw_material");
    $res = $obj->resultSet();
    echo json_encode($res);
}
if (isset($_POST['tipo']) && $_POST['tipo'] == '4') {
    $obj->query("SELECT id, producto FROM catalogo_indirectos");
    $res = $obj->resultSet();
    echo json_encode($res);
}
?>