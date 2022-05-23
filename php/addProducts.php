<?php 	
	require_once "Conexion.php";    
    $database = new Conexion;
    $id_prod ='';
    $update2 = false;
    $producto='';    
    if(isset($_POST['btnaddp'])){
    	if(!empty($_POST['comodity'])){
    		$selected = $_POST['comodity'];
            echo "tipo de producto:".$selected." | ";
    	}else{
    		echo 'Por favor seleciones un comodity.';
    	}
        $tipo = isset($_POST['comodity']) ? $_POST['comodity']:'';
        $producto = isset($_POST['cmbProducto']) ? $_POST['cmbProducto']:'';
        $producto_n = isset($_POST['txt_producto']) ? $_POST['txt_producto'] : '';
        $id_user2 = isset($_POST['txt_usr']) ? $_POST['txt_usr'] : '';
        echo "ID_usuario: ".$id_user2." | ";
        echo "nombre del producto: ".$producto;
        switch ($selected){
        	case '1':
                if(isset($_POST['addProducto'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_productos(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }

        	case '2':
                if(isset($_POST['addProducto'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_proceso(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }

            case '3':
                if(isset($_POST['addProducto'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_raw_material(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }

            case '4':            
                if(isset($_POST['addProducto'])){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");                    
                    $database->bind(1, $producto_n);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();

                    $database->query("INSERT INTO catalogo_indirectos(producto) VALUES(?)");
                    $database->bind(1, $producto_n);
                    $database->execute();

                    break;
                }else{
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user2);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }

        	default:
        		echo "Error en la consulta";
        		break;
        }
         header("location: /PaginaprincipalDeProveedores.php");

    }
    
    if(isset($_GET['deleteP'])){
        $id = $_GET['deleteP'];
        $_SESSION['message'] = "¡Se ha eliminado con éxito el contacto!";
        $_SESSION['msg_type'] = "danger";

        $database->query("DELETE FROM `producto` WHERE `ID_producto` = $id");
        $database->resultSet();

        header("location: /PaginaprincipalDeProveedores.php");
    }

    if(isset($_GET['editP'])){
        $id = $_GET['editP'];
        $database->query("SELECT * FROM producto WHERE ID_producto = $id");
        $rows = $database->resultSet();
        $update = true;
        foreach ($rows as $row ) :
            $id_prod= $row['ID_producto'];           
            $producto = $row['Producto'];            
        endforeach;        
    }
    if(isset($_POST['update'])){
        $id_producto = $_POST['ed_idp'] ? $_POST['ed_idp']: '';
        $n_porduct = $_POST['ed_namep'] ? $_POST['ed_namep']:'';

        $_SESSION['message'] = "¡Se ha modificado con éxito el producto!";
        $_SESSION['msg_type'] = "warning";

        $database->query("UPDATE `producto` SET `Producto` = '?' WHERE `producto`.`ID_producto` = ?");
        $database->bind(1, $n_porduct);
        $database->bind(2, $id_producto);
        $database->execute();

        header("location: /PaginaprincipalDeProveedores.php");
    }
?>