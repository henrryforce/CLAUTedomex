<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: /Login.html");
} else {
    $id_usr = $_SESSION['id_usuario'];
    include_once "php/Conexion.php";
    $obj = new Conexion;
    $obj->query("SELECT * FROM usuario WHERE id_usuario=$id_usr");
    $respuesta = $obj->resultSet();
    $id_empresa = intval($respuesta[0]['ID_empresa']);
    $obj->query("SELECT `Empresa` FROM `empresa` WHERE `ID_empresa` = $id_empresa");
    $emp = $obj->resultSet();
    $obj->query("SELECT * FROM `catalogo_estados` order by `nombre`");
    $estados = $obj->resultSet();
    $obj -> query("call GetIDs($id_usr);");
    $arrIDs = $obj -> resultSet();
    $obj -> query("SELECT `path`, `listaCerts` FROM `certificacionescomprador` WHERE `idcomprador`=$id_usr");
    $certs = $obj->resultSet();
//print_r($estados[0]['id'])

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
  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700;800&family=Encode+Sans+Condensed:wght@400;500;600;700;800&family=Gloria+Hallelujah&family=Kaushan+Script&family=Lobster&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:wght@300;400;500;600;700&family=Quicksand:wght@400;500;600;700&family=Rajdhani:wght@300;400;500;600;700&family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700;900&family=Saira+Condensed:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@500;600;700&display=swap"
    rel="stylesheet">

  <link href="css/all.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/owl.theme.default.min.css" />

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
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="top-contact-right d-flex justify-content-end">
              <ul class="list-unstyled d-flex">
                <li class="ms-3"> <a href="terms.html"> Terminos-condiciones </a> </li>
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
            <img src="images/LOGO NAVBAR 2.png" class="d-none d-lg-block " alt="logo" />
          </a>
          <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#mboile-show-menu" role="button"
            aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#"> Inicio</a>
              </li>
              <li class="nav-item"> <a class="nav-link" href="#">Requerimientos</a> </li>
              <li class="nav-item"> <a class="nav-link" href="#">Proveedores</a> </li>
              <li class="nav-item"> <a class="nav-link" href="#">Regístrate</a> </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Ingresar
                </a>
                <ul class="dropdown-menu dropdown-menu1" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#"> <i class="fas fa-angle-right"></i>Login proveedor</a></li>
                  <li><a class="dropdown-item" href="#"> <i class="fas fa-angle-right"></i> Login comprador </a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Aviso de privacidad</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Realizar pago</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a>
              </li>
              <li class="nav-item d-none">
                <p class="phon-text text-white"><i class="fas fa-phone-alt"></i> 555 234-8765 </p>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      </nav>
    </div>
  </div>
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
      <img src="images/pexels-photo-5580135.jpeg" alt="pb" />
    </div>
  </div>
  <section class="main-body pt-5 float-start industry-pages">
    <!-- COLOCAR CONTENIDO AQUÍ-->
    <div class="container mb-4 text-center">
      <!-- ENCABEZADOS-->
      <h4>CUENTA - PROVEEDOR</h4>
      <div>
      <a class="text-decoration-none" href="/PaginaprincipalDeProveedores.php">Regresar al Menu Principal</a>
      </div>
    </div>
    <!-- LABELS -->
    <div class="container text-center mb-2">
      <div class="card col-lg-12 mb-3">
        <div class="card-header">
          Datos personales
        </div>
        <!-- LABELS -->
        <div class="card-body mb-1">
          <form action="#" id="formPassword">
            <div id="notificaciones"></div>
            <!-- LABEL 1 -->
            <div class="col-lg-6 mx-auto mt-2">
              <input type="email" class="form-control" name="email" placeholder="Email"
                value="<?php echo $respuesta[0]['usuario']; ?>" disabled>
            </div>
            <!-- LABEL 2 -->
            <div class="col-lg-6 mx-auto mt-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <!-- LABEL 3 -->
            <div class="col-lg-6 mx-auto mt-3">
              <input type="password" class="form-control" name="password2" placeholder="Confirmar Password">
            </div>
            <!-- BOTON ACTUALIZAR -->
            <div class="container text-center mt-3">
              <button id="btnPassword" class="btn btn-primary text-center mb-1">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- OPCIONES CON MODALES -->
    <div class="container mb-3">
      <div class="card col-lg-12 mb-3">
        <div class="card-header text-center">
          Visualización
        </div>
        <!-- LABELS -->
        <div class="card-body mb-1">
          <!-- DATOS GENERALES -->
          <div class="container text-center">
            <div class="row g-3 mt-2 mb-2">
              <div class="col-sm">
                <p>Datos generales:</p>
              </div>
              <div class="col-sm">
                <!-- BOTON ACTIVA MODAL #1-->
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDatosGenerales">
                  <span>Visualizar</span></a>
              </div>
              <!-- CERTIFICACIONES -->
              <div class="container text-center">

                <div class="row g-3 mt-2 mb-2">
                  <div class="col-sm">
                    <p>Certificaciones:</p>
                  </div>
                  <div class="col-sm">
                    <!-- BOTON ACTIVA MODAL #2-->
                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCerts">
                      <span>Visualizar</span></a>

                  </div>
                  <!-- COMERCIO EXTERIOR -->
                  <div class="container text-center">

                    <div class="row g-3 mt-2 mb-2">
                      <div class="col-sm">
                        <p>Comercio exterior:</p>
                      </div>
                      <div class="col-sm">
                        <!-- BOTON ACTIVA MODAL #3-->
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" id="btnagregarpaises" data-bs-target="#exampleModal3">
                          <span>Visualizar</span></a>

                      </div>

                    </div>
                  </div>
                </div>
                <!-- Modal1 -->
                <div class="modal fade" id="modalDatosGenerales" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DATOS GENERALES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <?php
                      $id_detallesE = intval($arrIDs[0]['id_detalles']);
                       $obj ->query("SELECT * FROM `detalle_empresa` WHERE `ID_dtl_empresa` = $id_detallesE"); 
                       $datos = $obj ->resultSet();
                       $id_dir = intval($arrIDs[0]['id_direccion']);
                       $obj ->query("SELECT * FROM `direccion` WHERE `ID_direccion` = $id_dir");
                       $dir = $obj->resultSet();
                       
                       $id_ar = intval($arrIDs[0]['id_archivo']);
                       $obj ->query("SELECT `Logo`, `Presentacion` FROM `archivos` WHERE `ID_archivo` = $id_ar");
                       $arch = $obj -> resultSet();
                       
                       ?>
                       
                      <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="nom_empresa" style="background-color: #94181c; color:white">Todos los campos son
                            necesarios</label>
                        </div>
                        <form id="formDatosGenProveedor" action="#" enctype="multipart/form-data">
                          <div id="notificacionesMD"></div>
                          <div class="form-group">
                            <label for="nom_empresa">Nombre de la empresa</label>

                            <input type="text" class="form-control" id="nom_empresa" name="nom_empresa"
                              placeholder="Escriba aquí" value="<?php echo $emp[0]['Empresa'] ?>" disabled>
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Calle</label>
                            <input type="text" class="form-control" id="calle" name="calle" placeholder="Escriba aquí" value="<?php echo ($dir[0]['Calle']==''|| $dir[0]['Calle'] == NULL) ? '' : $dir[0]['Calle'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Numero Exterior</label>
                            <input type="text" class="form-control" id="num_ext" name="num_ext"
                              placeholder="Escriba aquí" value="<?php echo ($dir[0]['N_Ext']==''|| $dir[0]['N_Ext'] == NULL) ? '' : $dir[0]['N_Ext'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Numero Interior</label>
                            <input type="text" class="form-control" id="nim_int" name="nim_int"
                              placeholder="Escriba aquí" value="<?php echo ($dir[0]['N_Int']==''|| $dir[0]['N_Int'] == NULL) ? '' : $dir[0]['N_Int'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Código Postal</label>
                            <input type="number" class="form-control" id="cp" name="cp" placeholder="Escriba aquí" value="<?php echo ($dir[0]['CP']==''|| $dir[0]['CP'] == NULL) ? '' : $dir[0]['CP'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Colonia</label>
                            <input type="text" class="form-control" id="colonia" name="colonia"
                              placeholder="Escriba aquí" value="<?php echo ($dir[0]['Colonia']==''|| $dir[0]['Colonia'] == NULL) ? '' : $dir[0]['Colonia'] ; ?>">
                          </div>

                          <div class="form-group mt-3">
                            <label for="">Alcaldía o Delegación</label>
                            <input type="text" class="form-control" id="delegacion" name="delegacion"
                              placeholder="Escriba aquí" value="<?php echo ($dir[0]['Alcaldia']==''|| $dir[0]['Alcaldia'] == NULL) ? '' : $dir[0]['Alcaldia'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Estado</label>
                            <select type="text" class="form-control" id="estados" name="estados"
                              placeholder="Escriba aquí">
                              <option value="Selecicona un valor">Selecicona un valor</option>
                              <?php
                              $id_s='';
                                foreach ($estados as $row):
                                        //echo $row['nombre']; ID_estado
                                        $es = $row['nombre'];
                                        $id_es = $row['id'];
                                        ($dir[0]['ID_estado']!=$id_es) ?  : $id_s = ' selected="selected"' ;
                                        echo "<option value=" . $id_es ." ".  $id_s . ">$es</option>";
                                        $id_s='';
                                    endforeach;
                                    ?>
                            </select>
                          </div>
                          <br>
                          <div class="form-group mt-3">
                            <label for="">Número de empleados</label>
                            <input type="number" class="form-control" id="num_emp" name="num_emp"
                              placeholder="Escriba aquí empleados" value="<?php echo ($datos[0]['Num_empleados']==''|| $datos[0]['Num_empleados'] == NULL) ? '' : $datos[0]['Num_empleados'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Ventas Anuales</label>
                            <input type="number" class="form-control" id="ventas" name="ventas"
                              placeholder="Escriba aquí empleados" value="<?php echo ($datos[0]['Ventas_anuales']==''|| $datos[0]['Ventas_anuales'] == NULL) ? '' : $datos[0]['Ventas_anuales'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                              placeholder="Escriba aquí" value="<?php echo ($datos[0]['Tel']==''|| $datos[0]['Tel'] == NULL) ? '' : $datos[0]['Tel'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Ext</label>
                            <input type="tel" class="form-control" id="ext" name="ext" placeholder="Escriba aquí" value="<?php echo ($datos[0]['Ext']==''|| $datos[0]['Ext'] == NULL) ? '' : $datos[0]['Ext'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="">Pagina Web</label>
                            <input type="text" class="form-control" id="paginaweb" name="paginaweb"
                              placeholder="Escriba aquí" value="<?php echo ($datos[0]['Pagina_web']==''|| $datos[0]['Pagina_web'] == NULL) ? '' : $datos[0]['Pagina_web'] ; ?>">
                          </div>
                          <div class="form-group mt-3">
                            <label for="txtnegocio">Descripción del negocio</label>
                            <textarea type="text" class="form-control" id="txtnegocio" name="txtnegocio" rows="4"
                              cols="50" placeholder="Escriba aquí"><?php echo ($datos[0]['Descripcion']==''|| $datos[0]['Descripcion'] == NULL) ? '' : $datos[0]['Descripcion'] ; ?></textarea>
                          </div> 
                          <br>
                          <?php 
                         
                            if($arch[0]['Logo'] == NULL && $arch[0]['Presentacion'] == NULL){
                              echo "<div class=\"alert alert-danger\""." role="."alert"."><p>Adjunta los siguientes archivos</p></div>";
                          }if($arch[0]['Logo'] != NULL && $arch[0]['Presentacion'] != NULL){                           
                            echo "<div class=\"alert alert-warning\""." role="."alert"."><p>Ya cuentas con archivos cargados si subes uno nuevo los anteriores se borraran.</p></div>";
                          }
                          
                          ?>
                          <div id="notificacionesFiles"></div>
                          <div class="form-group mt-3">
                            <label class="mb-1" for="">Logo - tamaño máximo 1MB </label>
                            <input type="file" class="form-control" id="Logo" name="Logo"
                              aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                          </div>
                          <?php if($arch[0]['Logo'] != NULL){
                            $logo = $arch[0]['Logo'];
                            echo "<a href=\"../php/$logo\"target=\"_blank\">Logo Cargado</a>";
                          } ?>
                          
                          <div class="form-group mt-3">
                            <label class="mb-1" for="">Presentacion - tamaño máximo 1MB </label>
                            <input type="file" class="form-control" id="presentacion" name="presentacion"
                              aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                          </div>
                          <?php if($arch[0]['Presentacion'] != NULL){
                            $file = $arch[0]['Presentacion'];
                            echo "<a href=\"../php/$file\"target=\"_blank\">Archivo Cargado</a>";
                          } ?>
                          <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                          <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnDatosGenerales" class="btn btn-primary">Guardar</button>

                          </div>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END MODAL  1-->

                <div class="modal fade" id="modalCerts" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">DATOS GENERALES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                      <div class="modal-body">
                      <div class="alert alert-warning" role="alert">
                        Las Certificaciones no son Obligatorias, pero te ayudaran a destacar.
                      </div>
                      <div id="notificacionesMC"></div>
                        <form id="certyforms">
                          <div class="form-group mb-3">
                            <label for="">Certificaciones</label>
                            <textarea class="form-control" id="txtcerts" rows="3"
                              placeholder="Ingresa tus certificaciones separadas por comas"name="txtcerts"><?php  echo ($certs[0]['listaCerts']==''|| $certs[0]['listaCerts'] == NULL) ? '' : $certs[0]['listaCerts'] ; ?></textarea>
                          </div>
                          <?php if($certs[0]['path'] == ' '|| $certs[0]['path'] == NULL ){
                             echo "<div class=\"alert alert-danger\""." role="."alert"."><p>Adjunta Los archivos siguientes</p></div>";
                          }else{
                            echo"<div class=\"alert alert-warning\""." role="."alert"."><p>Ya cuentas con archivos cargados si subes uno nuevo los anteriores se borraran.</p></div>";
                          } ?>
                          <div class="form-group mt-3">
                            <label class="mb-1" for="">Certificaciones - tamaño máximo 1MB </label>
                            <input type="file" class="form-control" id="certdoc" name="certdoc"
                              aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                          </div>
                          <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                          <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnCerts" class="btn btn-primary">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal2 -->
                <!-- END MODAL 2-->

                <!-- Modal 3-->


                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comercio exterior</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                      <div class="modal-body">
                        <div id="notificacionesMP"></div>
                        <form action="#" id="formexport">
                        <label for="">Exportaciones A</label>
                        <select class="form-control mb-3" id="pais" name="pais">

                          <option value="0">Países</option>
                        </select>
                        <button class="btn btn-primary mb-3" type="submit" id="btnSavePais">Agregar</button>

                        <div class="card">
                          <!-- TITULO DE LA CARD -->
                          <h5 class="card-header">Exportación A</h5>

                          <!-- CUERPO DE LA CARD -->
                          <div id="listaPaises" class="card-body">
                            <!-- TAGS - CONTENIDO DE LA CARD -->

                          </div>
                        </div>
                      </div>
                      <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                      <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btnEnviar" href="#">Guardar</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- END MODAL 3-->
                <!-- FINAL DEL CONTENEDOR -->



  </section>
  <!-- FOOTER -->

  <footer>

    <div class="footer-link-div float-start pt-5">
      <div class="container">
        <div class="row row-cols-2 row-cols-md-2  row-cols-lg-4">
          <div class="col-6">
            <div class="comon-footer-div pt-4">
              <a href="#">
                <img src="images/logo-white.png" alt="logo" />
              </a>
              <h6 class="ft-call"> +52 55 55614048</h6>
              <p class="text-white"> esupplier@clautedomex.mx</p>
            </div>
          </div>
          <div class="col">
            <div class="comon-footer-div pt-4 justify-content-md-end d-grid">
              <h5 class="text-white"></h5>
              <ul class="list-unstyled mt-4">
                <li><a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> Facebook </a>
                </li>
                <li><a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i
                      class="fab fa-twitter w"></i>Twitter </a></li>
                <li><a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i>
                    Instagram </a></li>
                <li><a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i
                      class="fab fa-linkedin"></i>linkedin </a></li>
              </ul>
            </div>
          </div>
        </div>
        <hr />
        <div class="d-lg-flex justify-content-between">
          <p class="text-white"> Copyright © 2022</p>
          <div class="link-ft">
            <a href="#" class="ms-lg-3"> Aviso de privacidad </a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- modaible menu -->

  <div class="offcanvas offcanvas-start mobile-menu-div" tabindex="-1" id="mboile-show-menu"
    aria-labelledby="offcanvasExampleLabel">
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
              <a href="#" id="logout"> Cerrar sesión </a>
            </li>

          </ul>
        </div>

        <!-- REDES SOCIALES - RESPONSIVE -->

        <ul class="side-media list-unstyled">
          <li> <a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> </a>
          <li> <a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i class="fab fa-twitter w"></i>
            </a>
          <li> <a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i> </a>
          <li> <a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i
                class="fab fa-linkedin"></i> </a>
        </ul>
      </div>
    </div>
  </div>

  <!-- FIN RESPONSIVE -->
  <!-- FIN RESPONSIVE -->


  <!-- Back to top button -->
  <!-- Back to top button -->
  <!-- Back to top button -->
  <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
  </button>

  <!-- END BACK TO TOP BUTTON -->
<!-- Toast code-->
  <div class="toast-container position-absolute p-3 top-50 start-50 translate-middle" style="z-index: -10" id="toasContaider">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
      <div class="toast-header">

        <strong class="me-auto">Actualizar Contraseña</strong>

        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <span>¿Estas seguro de actualizar tu contraseña?</span>
        <span>
          <?php echo $respuesta[0]['usuario'] ?>
        </span>
        <div class="mt-2 pt-2 border-top">
          <button type="button" class="btn btn-primary btn-sm" id="btnToastCambiar">Cambiar</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <!-- script de funcionalidad NO ELIMINAR >:v  -->
  <script src="js/app.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.min.js"></script>
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
<?php
}
?>