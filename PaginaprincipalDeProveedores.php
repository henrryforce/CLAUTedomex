<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
  header("location: /Login.html");
 }else{
  $id_usr=$_SESSION['id_usuario'];
  if($_SESSION['tipoUser'] != '2'){
    header("location: /Login.html");
  }
}
  include_once "php/Conexion.php";
  require_once "php/addContactos.php";
  require_once "php/addProducts.php";
  $database=new Conexion;
  $obj = new Conexion();
  $obj -> query("SELECT  `Logo` FROM `archivos` WHERE `ID_archivo` = $id_usr");
  $res= $obj -> resultSet();
  $database-> query("SELECT * FROM contacto WHERE id_usuario=$id_usr");
  $rows = $database->resultSet();
  ?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> BAM24/7 </title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
    

     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700;800&family=Encode+Sans+Condensed:wght@400;500;600;700;800&family=Gloria+Hallelujah&family=Kaushan+Script&family=Lobster&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600;700&family=Rajdhani:wght@300;400;500;600;700&family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700;900&family=Saira+Condensed:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css"/>
   
  </head>
<body>
 <div class="main-menu-div float-start w-100">
    <div class="top-menu-sction float-start w-100 d-none d-md-none d-lg-block">      
        <div class="container">
             <div class="row row-cols-1 row-cols-lg-2">
               <div class="col">
                 <div class="top-contact-left">
                   <ul class="list-unstyled d-flex">
                     <li class="ms-4"> <i class="far fa-envelope"></i> info@bam24.com </li>
                   </ul></div> </div>
               <div class="col">
                 <div class="top-contact-right d-flex justify-content-end">
                   <ul class="list-unstyled d-flex">
                     <li class="ms-3"> <a href="PoliticaDeprivacidad.html"> Terminos-condiciones </a>  </li>
                   </ul>
                   <ul class="list-unstyled ms-4 socal-btn">
                     <li>
                       <a href="#"> <i class="fab fa-facebook-f"></i> </a>
                       <a href="#"> <i class="fab fa-google-plus-g"></i> </a>
                       <a href="#"> <i class="fab fa-instagram"></i> </a>
                     </li>
                   </ul>
                 </div>

               </div>
             </div>
        </div>
       
    </div>
    <div class="navication float-start w-100">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand" href="index.html">
             <img src="images/logo-white.png" class="d-none d-lg-block " alt="logo"/>
             <img src="images/logo-main.png" class="d-block d-md-block d-lg-none" alt="logo"/>
          </a>
          <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#mboile-show-menu" role="button" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  
            <li class="nav-item"> <a class="nav-link" href="index.html"> Inicio</a></li>
            <li class="nav-item"> <a class="nav-link" href="/VistaGeneral_Tractoras.php">Tractoras</a> </li>
            <li class="nav-item"> <a class="nav-link" href="/Registrate.html">Registro</a> </li>
            <li class="nav-item"> <a class="nav-link" href="/Login.html">Login</a> </li>
            
            
            
            <li class="nav-item accordion-item"> <a class="nav-link" id="logout" href="#">Cerrar sesión</a> </li>
             </li></ul>
             </div> </div> </nav> </nav> </div></div>  

 <div class="banner-home subpage-banner float-start">
     <div class="banner-content-sec">
        <div class="container">
         
              <div class="col-lg-8 mx-auto">
                <div class="comon-bedcum">                                      
                  </ul>
                </div>                                
              </div>                        
        </div>
     </div>     
    <div class="video-sec">
      <div class="video-bg"></div>      
       <img src="images/PROOVEDORES2.jpg" alt="pb"/>        
    </div>
 </div>

 <section class="main-body pt-5 float-start industry-pages">
                <!--------------------------------- CONTENEDOR DE ELEMENTOS --------------------------------->
                <!--------------------------------- COLOCAR CONTENIDO AQUÍ --------------------------------->           
                <!--------------------------------- UP BAR BUTTONS --------------------------------->
                <div class="container">
                <div class="card mt-5">
                  <div class="card-body">
				<div class="profile-userbuttons text-center mb-4">
					<button type="button" id="btnAdminPerfil" class="btn btn-success" style="background-color: #0371F1;">Administrar Perfil</button>
					<button type="button" class="btn btn-success" style="background-color: #0371F1;" data-bs-toggle="modal" data-bs-target="#modalInfoProvedor">Realizar pago</button>
          <a type="button" class="btn btn-primary" href="/Busquedatractoras.php">Lista de Tractoras</a>
				</div>
                <!-- ROW(->) COL(v)-->                                    
                <!-- LOGO Y NOMBRE DE LA MARCA-->
                <div class="container mb-4">                    
                    <section class="Profile-header text-center">
                        <div>
                            <!-- IMAGEN Y DIMENSIONES DE LA MISMA-->                            
                            <img src="<?php echo ($res[0]['Logo'] == ' ' ||  $res[0]['Logo'] == NULL ) ? 'php/archivosUpload/logos/default.png': './php/'.$res[0]['Logo']; ?>" alt="profile" class="img-rounded mb-3" width="230" height="120">
                        </div>
                        <?php 
                          $obj->query("SELECT usuario.ID_empresa, empresa.Empresa
                                            FROM usuario
                                            INNER JOIN empresa ON  usuario.ID_empresa=empresa.ID_empresa
                                            WHERE ID_usuario = $id_usr");
                          $rows = $obj->resultSet();
                          foreach($rows as $row){
                            $nombre_empresa = $row['Empresa'];
                          }
                        ?>
                        <h4 class=""><?php echo $nombre_empresa?></h4>                        
                        <a href="#" class="text-dark font-weight-bold text-decoration-none">Información personal</a>                        
                </div>

                </div>
                </div>
                </div>     

                
            
            <!--------------------------------- TABLA EDITAR --------------------------------->   
            <div class="container">
                <div class="card mt-5 mb-5">
                  <div class="card-body">

            <section id = "tabEditar" class="container mt-2 mb-2 p-2 ">
              <form action="php/addContactos.php" method="POST">                
                <div class="table-responsive">
                  <div class="table-wrapper">
                      <div class="table-title">
                      <h4 class="text-center mt-2">Editar información</h4>                        
                          <div class="row">
                              <div class="col-xs-6">
                                <?php if(isset($_SESSION['message'])): ?>              
                                        <div class="alert alert-<?=$_SESSION['msg_type']?>"  role="alert">
                                <?php 
                                          echo $_SESSION['message'];
                                          unset($_SESSION['message']);
                                ?>
                                        </div>
                                <?php endif ?>
                              </div>
                              <!-- BOTONES DE LA TABLA--> 
                                <div class="col-xs-6 mb-3">                                  
                                  <?php if($update == true):?>
                                    <button type="submit" class="btn btn-primary" name="update" style="display:show;">Actualizar</button>
                                  <?php else:?>                                                                
                                    <button type="submit" class="btn btn-primary" name="update" style="display:none;">Guardar</button>
                                  <?php endif; ?>                                    
                                </div>                                                          
                          </div>
                      </div>
                      <!-- BOTONES DE LA TABLA--> 
                      <table class="table table-hover table-hover text-center">
                          <thead>
                              <tr>                                                                                                   
                                  <th>Nombre</th>
                                  <th>Puesto</th>
                                  <th>Email</th>
                                  <th>Teléfono</th>
                                  <th>Extensión</th>
                                  <th>Celular</th>                                                                    
                              </tr>
                          </thead>                          
                          <tbody>                                                            
                              <tr>
                                <input type="hidden" id="ed_id" name="ed_id" value="<?php echo $id_cont; ?>">
                                <td><input class="form-control" type="text" id="ed_name" name="ed_name" value="<?php echo $name; ?>" placeholder="Nombre"></td>
                                <td><input class="form-control" type="text" id="ed_job" name="ed_job" value="<?php echo $job; ?>" placeholder="Puesto"></td>
                                <td><input class="form-control" type="text" id="ed_mail" name="ed_mail" value="<?php echo$mail; ?>" placeholder="Email"></td>
                                <td><input class="form-control" type="text" id="ed_tel" name="ed_tel" value="<?php echo $tele; ?>" placeholder="Telefono"></td>
                                <td><input class="form-control" type="text" id="ed_ext" name="ed_ext" value="<?php echo $exte; ?>" placeholder="Extensión"></td>
                                <td><input class="form-control" ype="text" id="ed_cel" name="ed_cel" value="<?php echo $cel; ?>" placeholder="Celular"></td>                                  
                              </tr>
                          </tbody>
                      </table>
                    </div>
                </div>             
              </form>
            </section>
            <!--------------------------------- TABLA 1 --------------------------------->             
            <div class="container">
              <form action="php/addContactos.php" id="addContacts" name="adc" method="POST">
                <div class="table-responsive">
                  <div class="table-wrapper">
                      <div class="table-title">
                          <div class="row">
                              <div class="col-xs-6">                                  
                              </div>
                              <!-- BOTONES DE LA TABLA--> 
                              <!-- BOTONES DE LA TABLA-->                               
                                <div class="col-xs-6 mb-3">                                 
                                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tablaModal" style="background-color: #0371F1;"> <span>Agregar</span></a>                                  
                                </div>                                                          
                          </div>
                      </div>
                      <!-- BOTONES DE LA TABLA--> 
                      <table class="table table-striped table-hover text-center">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Puesto</th>
                                  <th>Email</th>
                                  <th>Teléfono</th>
                                  <th>Extensión</th>
                                  <th>Celular</th>                                  
                                  <th>Opciones</th>
                              </tr>
                          </thead>                          
                          <tbody>      
                            <?php $database-> query("SELECT * FROM contacto WHERE ID_usuario=$id_usr");?>
                            <?php $rows = $database->resultSet();?>
                              <?php foreach($rows as $row) :?>
                              <tr>                                                                    
                                <td><?php echo $row['Nombre']?></td>
                                <td><?php echo $row['Puesto']?></td>
                                <td><?php echo $row['Email']?></td>
                                <td><?php echo $row['Tel']?></td>
                                <td><?php echo $row['Ext']?></td>
                                <td><?php echo $row['Cel']?></td>
                                <input type="hidden" id="txt_usr" name="txt_usr" value="<?php echo $id_usr?>">
                                <!-- OPCIONES--> 
                                <td>
                                  <ul class="list-group list-group-horizontal">
                                    <a href="PaginaprincipalDeProveedores.php?edit=<?php echo $row['ID_contacto']?>" class=" list-group-item"><i class="bi bi-pencil-square">Edit</a></i>
                                    <a href="php/addContactos.php?delete=<?php echo $row['ID_contacto'];?>" class=" list-group-item"><i class="bi bi-archive-fill">Delete</a></i>
                                  </ul>                                    
                                </td>
                              </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
                    </div>
                </div>
              </form>
              <!------------------------------------------ MODAL  ------------------------------------------>          

<form action="php/addContactos.php" id="addContacts" name="adc" method="post">
  <div class="modal fade" id="tablaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CONTACTO</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
              <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->         
              <div class="modal-body">              
                <form action="php/addProducts.php" id="addContacts" name="apd" method="POST">
                  <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" placeholder="Ejemplo: Alejandro Lopez Lopez">
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput2">Puesto</label>
                    <input type="text" class="form-control" id="txt_puesto" name="txt_puesto"  placeholder="Ejemplo: IT Support">
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput3">Email</label>
                    <input type="email" class="form-control" id="txt_mail" name="txt_mail" placeholder="Ejemplo: ale2201@example.com">
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput4">Teléfono</label>
                    <input type="tel" class="form-control" id="txt_tel" name="txt_tel" placeholder="Ejemplo: 55-55-55-55">
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput5">Extensión</label>
                    <input type="number" class="form-control" id="txt_ext" name="txt_ext" placeholder="Ejemplo: 2201">
                  </div>

                  <div class="form-group mt-3">
                    <label for="exampleFormControlInput6">Celular</label>
                    <input type="tel" class="form-control" id="txt_cel" name = "txt_cel" placeholder="Ejemplo: 55-55-55-55">
                    <input type="hidden" id="txt_usr" name="txt_usr" value="<?php echo $id_usr?>">
                    <input type="hidden" id="txt_val" name="txt_val" value="1">
                  </div>                  
                </form>                                                  
              </div>
              <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>-
              <input href="PaginaprincipalDeProveedores.php?edit=<?php echo $row['ID_contacto'];?>" type="submit" name= "btnadd" class="btn btn-primary" value="Guardar">
              </div>
              </div>
              </div>
              </div>
              </form>
               <!-- END MODAL -->
               <!-- END MODAL -->
               <!-- END MODAL -->                                     
                  </div>
              </div>        
          </div>
          
          </div>
          </div>
          </div>
  


                  
          <!------------------------------------------- TABLA 2 ------------------------------------------->     
          <div class="container">
          <div class="card mt-5 mb-5">
          <div class="card-body">                



            <form action="php/addProducts.php" id="addContacts" name="adc" method="POST">
              <div class="table-responsive">                  
                  <div class="table-wrapper">
                      <div class="table-title">
                          <h4 class="text-center mt-2">Productos agregados</h4>
                          <div class="row">
                              <div class="col-xs-6">                                  
                              </div>
                              <!-- BOTONES DE LA TABLA--> 
                              <!-- BOTONES DE LA TABLA--> 
                              <div class="col-xs-6 mb-3">
                                  <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2"> <span>Agregar</span></a>				
                              </div>
                          </div>
                      </div>
                      <!-- BOTONES DE LA TABLA--> 
                      <table class="table table-striped table-hover text-center">
                          <thead>
                              <tr>                                  
                                <th>ID</th>                                
                                <th>Producto</th>
                                <th>Opciones</th>
                              </tr>
                          </thead>                          
                          <tbody>
                            <?php $database->query("SELECT ID_producto, Producto, ID_catalogo from producto_proveedor WHERE id_usuario=$id_usr");
                            $res = $database->resultSet();?>
                            <?php foreach($res as $row) :?>
                              <tr>                                
                                <td><?php echo $row['ID_producto']?></td>            
                                <td><?php echo $row['Producto']?></td>
                                <?php if(!isset($row['ID_producto'])){
                                      $id_p='';
                                    }else{
                                      $id_p = $row['ID_producto'];
                                    }?>
                                  <!-- OPCIONES--> 
                                  <td>                                    
                                    <a href="php/addProducts.php?deleteP=<?php echo $id_p;?>" class="list-group-item"><i class="bi bi-archive-fill">        Delete</a></i>
                                  </td>
                              </tr>
                              <?php endforeach; ?>
                          </tbody>
                      </table>
            </form>
                      <!------------------------------------------ MODAL 2  ------------------------------------------>         
                      <form action="php/addProducts.php" id="addContacts" name="adc" method="POST">
              <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AGREGAR PRODUCTO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL2 -->
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Comodity </label>
                      <select class="form-control" name="comodity" id="comodity" >
                        <option>- Seleccione una opción -</option>
                        <option value="1">Producto</option>
                        <option value="2">Proceso</option>
                        <option value="3">Materia prima</option>
                        <option value="4">Servicios indirectos</option>                        
                      </select>
                    </div>
                    <!-- Creacion del combo con los productos de c/u de los catalogos -->
                    <div class="form-group mt-3"> 
                      <label for="exampleFormControlSelect1">Producto</label>                                                                     
                      <select class="form-control" name="cmbProducto" id="cmbProducto">
                      </select>
                    </div>
                    <div class="form-group mt-3">
                      <label for="exampleModalLabel">¿No encuentras tu producto?</label><br><br>                                                                  
                      <input type="checkbox" name="addProducto" class="i-radio form-check-input" value="addProducto"> Agregar producto
                      <input type="text" name="txt_producto" id="txt_producto" class="i-text form-control" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Ejemplo: Electrical Contacts">
                    </div>
                    <div class="form-group mt-3">
                      <input type="hidden" id="txt_usr" name="txt_usr" value="<?php echo $id_usr?>">
                    </div>                                  
                  </form>                                                          
                </div>
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL2 -->
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input href="PaginaprincipalDeProveedores.php?edit=<?php echo $id_p;?>" type="submit" name= "btnaddp" class="btn btn-primary" value="Guardar">
                </div>
                </div>
                </div>
                </div>
                 <!-- END MODAL2 -->
                  </div>
              </div>        
          </div>
          </form>  
          
          </div>
          </div>
          </div>

    <!-- FINAL DEL CONTENEDOR -->    
</section>
 <!-- FOOTER -->


 <div class="footer-link-div float-start pt-5">
  <div class="container">
     <div class="row row-cols-2 row-cols-md-2  row-cols-lg-4">
        <div class="col-6">
           <div class="comon-footer-div pt-4">
               <a href="#">
                  <img src="images/logo-white.png" alt="logo"/>
               </a>

              <h6 class="ft-call"> +52 55 55614048 </h6>
              <p class="text-white">esupplier@clautedomex.mx</p>
           </div>
        </div> 
        <div class="col">
          <div class="comon-footer-div pt-4 justify-content-md-end d-grid">
              <h5 class="text-white"></h5>
              <ul class="list-unstyled mt-4">
              <li><a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> Facebook </a></li>
                      <li><a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i class="fab fa-twitter w"></i>Twitter </a></li>
                      <li><a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i> Instagram </a></li> 
                      <li><a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i class="fab fa-linkedin"></i>linkedin </a></li>
                </li> </ul>
              </div>
            </div>
          </div>             
      <hr/>
      <div class="d-lg-flex justify-content-between">
        <p class="text-white"> Copyright © 2022</p>
        <div class="link-ft">
           <a href="#"> Terminos-condiciones </a>
           <a href="#" class="ms-lg-3"> Aviso de privacidad </a>
        </div> </div> </div></div>
      
</footer>

                <!------------------------------ Modal ------------------------------>
                <div class="modal fade" id="modalInfoProvedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_pago">Informacion de Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form class="row g-3">   
            <div class="row">
              <div class="col-sm-6 form-control-plaintext text-bold">Medios de pago</div>            
            </div> 
            <div class="row">
              <div class="col-sm-6 form-control-plaintext"><p>Cluster Automotriz Regional Estado de México A.C. <br>
                 <strong> Número de Cuenta:</strong> 0112562251 <br>
                 <strong> Clabe interbancaria:</strong> 012180001125622513</p></div>            
            </div>
            <div class="row">
              <div class="col-sm-6 form-control-plaintext">Pago con Mercado Pago</div>  
              
              <!------------------------------ IMAGEN DE MERCADOPAGO ------------------------------>
              <div class="container">
              <img class="card-img-top" src="/images/Mercadopagologo1.png" alt="Card image cap">
              </div>                    


            </div>
            
          </form>
        </div>
      </div>
      <div class="modal-footer">                
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
        <a type="button" class="btn btn-primary" href="https://mpago.la/1XAnXpA" data-bs-dismiss="modal">Pagar con Mercado Pago</a>
      </div>
    </div>
  </div>
</div><!------------------------------ Fin Modal ------------------------------>

<!-- modaible menu -->

<div class="offcanvas offcanvas-start mobile-menu-div" tabindex="-1" id="mboile-show-menu" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <button type="button" class="close-menu" data-bs-dismiss="offcanvas" aria-label="Close">
      <span> Cerrar </span> <i class="fas fa-long-arrow-alt-right"></i>
     </button>
  </div>
  <div class="offcanvas-body">
    <div class="head-contact">
      <a href="index.html" class="logo-side">
      <img src="images/logo-main.png" alt="logo">
      </a>
     
      <div class="mobile-menu-sec mt-3">
         <ul class="list-unstyled">
            <li>
               <a href="index.html"> Inicio </a>
            </li>
            <li>
               <a href="#"> Tractoras </a>
            </li>
            <li>
               <a href="#"> Registro </a>
            </li>
            <li>
               <a href="#"> Login </a>
            </li>
            <li>
               <a href="#"> Costo </a>
            </li>          
            <li>
              <a href="#" class="" id="logout2"> Cerrar sesión </a>
           </li>            
         </ul>
      </div>
      <!---------------------------------- REDES SOCIALES - RESPONSIVE ---------------------------------->

      <ul class="side-media list-unstyled">
         <li> <a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> </a> 
         <li> <a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i class="fab fa-twitter w"></i> </a>
         <li> <a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i> </a>
         <li> <a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i class="fab fa-linkedin"></i> </a>
      </ul>
    </div>
  </div>
</div>

<!-- FIN RESPONSIVE -->
<script src="js/app.js"></script>
<script src="js/bootstrap.bundle.min.js" ></script>
<script src="js/jquery.min.js" ></script>
</script>
<!-- Owl Carousel -->
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
<script>
AOS.init({
  offset: 100,
  easing: 'ease',
  delay: 0,
  once: true,
  duration: 800,
});
</script>
</body>
</html>