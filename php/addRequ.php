<?php 
	
	require_once "Conexion.php";
	$database = new Conexion;

	$update3 = false;
	$id_req= '';
	$tMat= '';
	$vol= '';
	$coment= '';

	if (isset($_POST["btnaddr"])) {
        if(!empty($_POST['comodity'])){
    		$sel_com = $_POST['comodity'];
            echo "tipo de producto:".$sel_com." | ";
    	}else{
    		echo 'Por favor seleciones un comodity.';
    	}
		
		$productoR = isset($_POST['cmbProducto']) ? $_POST['cmbProducto'] : '';
		$t_material = isset($_POST['txt_typeM']) ? $_POST['txt_typeM'] : '';
		$volumen  = isset($_POST['txt_vol']) ? $_POST['txt_vol'] : '';
		$coments = isset($_POST['txt_aComents']) ? $_POST['txt_aComents'] : '';
		$id_user3 = isset($_POST['txt_usuR']) ? $_POST['txt_usuR'] : '';

		$_SESSION['message'] = "¡Se han agregado con éxito los requerimientos!";
        $_SESSION['msg_type'] = "success";

        switch ($sel_com){
        	case '1':
                if(isset($_POST['addRequerimiento'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_productos(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();
                    
                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    break;
                }

        	case '2':
                if(isset($_POST['addRequerimiento'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_proceso(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    break;
                }

            case '3':
                if(isset($_POST['addRequerimiento'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_raw_material(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    break;
                }

            case '4':            
                if(isset($_POST['addRequerimiento'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_indirectos(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $sel_com);
                    $database->execute();

                    $database->query("INSERT INTO requerimiento_producto (Tipo_material, Volumen_anual, Comentarios, ID_usuario) VALUES (?,?,?,?)");
                    $database->bind(1, $t_material);
                    $database->bind(2, $volumen);
                    $database->bind(3, $coments);
                    $database->bind(4, $id_user3);
                    break;
                }

        	default:
        		echo "Error en la consulta";
        		break;
        }
        header("location: /PaginaprincipalDeTractoras.php");
	}
	if(isset($_GET['deleteq'])){
        $id = $_GET['deleteq'];
        $_SESSION['message'] = "¡Se ha eliminado con éxito el requerimiento!";
        $_SESSION['msg_type'] = "danger";

        $database->query("DELETE FROM `requerimiento_producto` WHERE `ID_req_producto` = $id");
        $database->resultSet();

        header("location: /PaginaprincipalDeTractoras.php");
    }
    if(isset($_GET['editq'])){
        $id = $_GET['editq'];
        $database->query("SELECT * FROM requerimiento_producto WHERE ID_req_producto = $id");
        $rows = $database->resultSet();
        $update3 = true;
        foreach ($rows as $row ) :
            $id_req= $row['ID_req_producto'];
			$tMat= $row['Tipo_material'];
			$vol= $row['Volumen_anual'];
			$coment= $row['Comentarios'];
        endforeach;        
    }
    if(isset($_POST['update2'])){
        $id_req = $_POST['ed_idr'] ? $_POST['ed_idr']:'';
        $tipo_m = $_POST['ed_typeM'] ? $_POST['ed_typeM']: '';            
        $volm = $_POST['ed_vol'] ? $_POST['ed_vol']: '';
        $comm= $_POST['ed_comm'] ? $_POST['ed_comm']: '';        
        
        $_SESSION['message'] = "¡Se ha modificado con éxito!";
        $_SESSION['msg_type'] = "warning";

        $database->query("UPDATE `requerimiento_producto` SET `Tipo_material` = ?, `Volumen_anual` = ?, `Comentarios` = ? WHERE `requerimiento_producto`.`ID_req_producto` = ?;");
        $database->bind(1, $tipo_m);
        $database->bind(2, $volm);
        $database->bind(3, $comm);
        $database->bind(4, $id_req);
        $database->execute();
        
        header("location: /PaginaprincipalDeTractoras.php");
    }

 ?>