<?php 	
	require_once "Conexion.php";    
    $database = new Conexion;

    $update = false;

    if(isset($_POST['btnaddp'])){
    	if(!empty($_POST['comodity'])){
    		$selected = $_POST['comodity'];
            echo "tipo de producto:".$selected." | ";
    	}else{
    		echo 'Por favor seleciones un comodity.';
    	}
        $tipo = isset($_POST['comodity']) ? $_POST['comodity']:'';
        $producto = isset($_POST['txt_prod']) ? $_POST['txt_prod']:'';    	
        $id_user = $_COOKIE['user_id'];
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
                $database->query("SELECT `producto` FROM `catalogo_proceseo` WHERE producto LIKE '%$producto%'");
                $res = $database->resultSet();
                if(!empty($res)){
                    $database->query("INSERT INTO producto(producto, ID_usuario, ID_catalogo) VALUES(?,?,?)");
                    $database->bind(1, $producto);
                    $database->bind(2, $id_user);
                    $database->bind(3, $selected);
                    $database->execute();
                    break;
                }else{
                    $database->query("INSERT INTO catalogo_producto(producto) VALUES(?)");
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
         header("location: /CLAUTedomex/PaginaprincipalDeProveedores.php");

    }
    
    if (isset($_POST['variable'])) {
        // code...
    }

?>