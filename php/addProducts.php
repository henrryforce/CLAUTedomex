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
        $producto = isset($_POST['txt_prod']) ? $_POST['txt_prod']:'';    	
        $id_user = isset($_POST['txt_usr']) ? $_POST['txt_usr'] : '';
        echo "ID_usuario: ".$id_user." | ";
        echo "nombre del producto; ".$producto;
        switch ($selected){
        	case '1':
        		$database->query("SELECT `producto` FROM `catalogo_productos` WHERE producto LIKE '%$producto%'");
                $res = $database->resultSet();
                if(!empty($res)){                    
                    echo "tipo de producto:".$selected." | ";
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user);
                    $database->bind(3, $selected);
                    $database->execute();

                    break;

                }else{
                    $database->query("INSERT INTO catalogo_productos(producto) VALUES(?)");
                    $database->bind(1, $producto);
                    $database->execute();
                }

                $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                $database->bind(1, $producto);
                $database->bind(2, $id_user);
                $database->bind(3, $selected);
                $database->execute();

        		break;
        	case '2':
                $database->query("SELECT `producto` FROM `catalogo_proceso` WHERE producto LIKE '%$producto%'");
                $res = $database->resultSet();
                if(!empty($res)){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO catalogo_productos(producto) VALUES(?)");
                    $database->bind(1, $producto);
                    $database->execute();
                }
                $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                $database->bind(1, $producto);
                $database->bind(2, $id_user);
                $database->bind(3, $selected);
                $database->execute();
                break;
            case '3':
                $database->query("SELECT `producto` FROM `catalogo_raw_material` WHERE producto LIKE '%$producto%'");
                $res = $database->resultSet();
                if(!empty($res)){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(1, $id_user);
                    $database->bind(1, $selected);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO catalogo_raw_material(producto) VALUES(?)");
                    $database->bind(1, $producto);
                    $database->execute();
                }
                $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                $database->bind(1, $producto);
                $database->bind(1, $id_user);
                $database->bind(1, $selected);
                $database->execute();                
                break;
            case '4':            
                $database->query("SELECT `producto` FROM `catalogo_indirectos` WHERE producto LIKE '%$producto%'");
                $res = $database->resultSet();
                if(!empty($res)){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(1, $id_user);
                    $database->bind(1, $selected);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO catalogo_indirectos(producto) VALUES(?)");
                    $database->bind(1, $producto);
                    $database->execute();
                }
                $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                $database->bind(1, $producto);
                $database->bind(1, $id_user);
                $database->bind(1, $selected);
                $database->execute();
                break;
        	default:
        		echo "Error en la consulta";
        		break;
        }
         header("location: /PaginaprincipalDeProveedores.php");

    }
    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
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
?>