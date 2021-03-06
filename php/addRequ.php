<?php 
	
	require_once "Conexion.php";
	$database = new Conexion;
    //Inicializacion de variables para la tabla editar Requerimientos
	$update3 = false;
	$id_req= '';
	$tMat= '';
	$vol= '';
	$coment= '';
    //validacion para alertar que no se eligió un Catalogo
	if (isset($_POST["btnaddr"])) {
        if(!empty($_POST['comodity'])){
    		$sel_com = $_POST['comodity'];
            echo "tipo de producto:".$sel_com." | ";
    	}else{
    		echo 'Por favor seleciones un comodity.';
    	}
        //Variables en donde se obtienen los valores del formulario Pagina principal de Tractoras
		$productoR = isset($_POST['cmbProducto']) ? $_POST['cmbProducto'] : '';
        $productoR_n = isset($_POST['txt_productoR']) ? $_POST['txt_productoR'] : '';
		$t_material = isset($_POST['txt_typeM']) ? $_POST['txt_typeM'] : '';
		$volumen  = isset($_POST['txt_vol']) ? $_POST['txt_vol'] : '';
		$coments = isset($_POST['txt_aComents']) ? $_POST['txt_aComents'] : '';
		$id_user3 = isset($_POST['txt_usuR']) ? $_POST['txt_usuR'] : '';

		$_SESSION['message'] = "¡Se han agregado con éxito los requerimientos!";
        $_SESSION['msg_type'] = "success";

        //Switch case en donde realiza los insert en las tablas Productos y Requerimiento_producto, con base en el catalogo seleccionado
        switch ($sel_com){
        	case '1': //Se insertan los datos en las tablas Productos y Requerimiento_producto con el Comodity Productos                
                if(isset($_POST['addRequerimiento'])){ //Validacion en caso de que el usuario requiera registrar un nuevo producto
                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();
                    
                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3");                    
                    $rows= $database->resultSet();
                    foreach($rows as $row):
                        $id = $row['ID_req_producto'];
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR_n);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute(); 

                    $database->query("INSERT INTO catalogo_productos(producto) VALUES(?)");
                    $database->bind(1, $productoR_n);
                    $database->execute();
                    
                    break;
                }else{//Se insertan los datos en las tablas Productos y Requerimiento_producto con el Comodity Productos con el producto registrado en el catalogo                
                    $database->query("INSERT INTO requerimiento_producto(Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();
                    

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute();                                                            
                    break;
                }

        	case '2':
                if(isset($_POST['addRequerimiento'])){

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR_n);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute();                     

                    $database->query("INSERT INTO catalogo_proceso(producto) VALUES(?)");
                    $database->bind(1, $productoR_n);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute(); 

                    
                    break;
                }

            case '3':
                if(isset($_POST['addRequerimiento'])){

                    $database->query("INSERT INTO requerimiento_producto(Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR_n);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute(); 
                    
                    $database->query("INSERT INTO catalogo_raw_material(producto) VALUES(?)");
                    $database->bind(1, $productoR_n);
                    $database->execute();
                    break;
                }else{

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute();                     
                    break;
                }

            case '4':            
                if(isset($_POST['addRequerimiento'])){

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR_n);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute(); 

                    $database->query("INSERT INTO catalogo_indirectos(producto) VALUES(?)");
                    $database->bind(1, $productoR_n);
                    $database->execute();                    
                    break;
                    
                }else{

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    $database->execute();

                    $database->query("SELECT * FROM requerimiento_producto WHERE ID_usuario= $id_user3"); //Se obtiene el ultimo                    
                    $rows= $database->resultSet();                                                        //ID del la tabla requerimiento_producto
                    foreach($rows as $row):                                                               //para poder agregarlo como llave foranea en 
                        $id = $row['ID_req_producto'];                                                    //la tabla producto
                    endforeach;
                    echo "ultimo id: ".$id;

                    $database->query("INSERT INTO producto_tractora(producto, ID_req_producto, ID_usuario, ID_catalogo) VALUES(?,?,?,?)");
                    $database->bind(1, $productoR);
                    $database->bind(2, $id);
                    $database->bind(3, $id_user3);
                    $database->bind(4, $sel_com);
                    $database->execute();                                        
                    break;
                }

        	default:
        		echo "Error en la consulta";
        		break;
        }
        header("location: /PaginaprincipalDeTractoras.php");
	}
    //Validacion para eliminar requerimiento 
	if(isset($_GET['deleteq'])){
        $id = $_GET['deleteq'];
        $_SESSION['message'] = "¡Se ha eliminado con éxito el requerimiento!";
        $_SESSION['msg_type'] = "danger";

        $database->query("DELETE FROM `requerimiento_producto` WHERE `ID_req_producto` = $id");
        $database->resultSet();

        header("location: /PaginaprincipalDeTractoras.php");
    }
    //Validacion para poder enviar los datos que se quieran editar a la tabla Editar Requemimientos
    if(isset($_POST['editq'])){
        $id = $_POST['editq'];
        $database->query("SELECT * FROM requerimiento_producto WHERE ID_req_producto = $id");
        $rows = $database->resultSet();
        echo json_encode($rows);
    }
    //Validacion para modificar los datos de la tabla Editar Requerimientos
    if(isset($_POST['update2'])){
        $id_req = $_POST['ed_idr'] ? $_POST['ed_idr']:'';
        $tipo_m = $_POST['editmateriales'] ? $_POST['editmateriales']: '';            
        $volm = $_POST['editvol'] ? $_POST['editvol']: '';
        $comm= $_POST['editComents'] ? $_POST['editComents']: '';        
        
        $_SESSION['message'] = "¡Se ha modificado con éxito!";
        $_SESSION['msg_type'] = "warning";

        $database->query("UPDATE `requerimiento_producto` SET `Tipo_material` = ?, `Volumen_anual` = ?, `Comentarios` = ? WHERE `requerimiento_producto`.`ID_req_producto` = ?;");
        $database->bind(1, $tipo_m);
        $database->bind(2, $volm);
        $database->bind(3, $comm);
        $database->bind(4, $id_req);
        $database->execute();
        
        echo json_encode('200');
    }

 ?>