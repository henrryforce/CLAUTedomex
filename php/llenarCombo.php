<?php
require_once "Conexion.php";

if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
    // Recibimos un valor del AJAX
    $valor = $_POST["valor"];

    $database = new Conexion;
    

switch ($valor) {
    case '1':
      $error=0;
      $mensaje = "Mostrando Opciones";
      $database->query("SELECT producto FROM catalogo_productos");
      $prods = $database->resultSet();
      $datos = array();
      foreach($prods as $row):  
        $datos="<option value=''>- Seleccione -</option>";
        $datos= $datos['Productos'][]=$row;
      endforeach;  
      break;

    case 2:
      $error=0;
      $mensaje = "Mostrando Opciones";
      $datos="<option value=''>- Seleccione -</option>";
      $datos = $datos."<option value='1'>- Opcion B. 1 -</option>";
      $datos = $datos."<option value='2'>- Opcion B. 2 -</option>";
      $datos = $datos."<option value='3'>- Opcion B. 3 -</option>";
      break;

    case 3:
      $error=0;
      $mensaje = "Mostrando Opciones";
      $datos="<option value=''>- Seleccione -</option>";
      $datos = $datos."<option value='1'>- Opcion C. 1 -</option>";
      $datos = $datos."<option value='2'>- Opcion C. 2 -</option>";
      $datos = $datos."<option value='3'>- Opcion C. 3 -</option>";
      break;
    default:
      // code...
      break;
  }
   //empaquetar json
   $resp=[
    "error"=>$error,
    "mensaje"=>$mensaje,
    "datos"=>$datos
   ];
    //Devolvemos una respuesta al AJAX
    echo json_encode($resp);


}
?>