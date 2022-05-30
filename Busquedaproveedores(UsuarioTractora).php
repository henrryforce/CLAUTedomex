<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("location: /Login.html");
} else {
    include 'php/Conexion.php';
    include 'php/emailsender.php';
    $obj = new Conexion();
    $obj->query("Select ID_usuario from usuario where ID_tipo_usr=2;");
    $idsProvedores = $obj->resultSet();
    //print_r($idsProvedores);
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
                  <a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> </a>
                  <a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i
                      class="fab fa-twitter w"></i> </a>
                  <a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i> </a>
                  <a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i
                      class="fab fa-linkedin"></i> </a>
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
              <li class="nav-item"> <a class="nav-link" href="index.html"> Inicio</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Tractoras</a> </li>
              <li class="nav-item"> <a class="nav-link" href="#">Registro</a> </li>
              <li class="nav-item"> <a class="nav-link" href="#">Login</a> </li>
              <li class="nav-item"> <a class="nav-link" href="#">Costo</a> </li>
              <li class="nav-item accordion-item"> <a class="nav-link" href="#">Cerrar sesión</a> </li>


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





    <!-- CONTENEDOR DE ELEMENTOS-->
    <!-- COLOCAR CONTENIDO AQUÍ-->
    <!-- COLOCAR CONTENIDO AQUÍ-->
    <!-- COLOCAR CONTENIDO AQUÍ-->
    <!-- COLOCAR CONTENIDO AQUÍ-->




    <!--CONTENEDOR DE LABELS-->
    <!--CONTENEDOR DE LABELS-->
    <!--CONTENEDOR DE LABELS-->
    <!--CONTENEDOR DE LABELS-->

    <div class="container mb-5">

      <div class="card">
        <!--TITULO DE LA CARTA-->
        <h5 class="card-header text-center">Lista de proveedores</h5>
        <!--CUERPO DE LA CARD (CONTENIDO)-->
        <div class="card-body">
          <form>
            <!--LABEL SELECTOR DE OPCIONES-->
            <div class="form-group mb-4">
              <label for="exampleFormControlSelect1">Tipo de servicio</label>
              <select class="form-control" id="exampleFormControlSelect1">
                <option>Seleccione una opción</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
            <!--CATALOGO DE SERVICIO SELECCIONADO-->
            <fieldset disabled>
              <div class="form-group">
                <label for="disabledTextInput">Catálogo de servicio seleccionado</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
              </div>
          </form>
        </div>
      </div>
    </div>
    <!--CONTENEDOR DE TARJETAS-->
    <div class="container mt-1">
      <a href="#" target="_blank" rel="noopener noreferrer" id="lbltest">Etiqueta de prueba</a>
      <div class="row h-100">
      <?php
        foreach ($idsProvedores as $proveedor) {
                $id = $proveedor['ID_usuario'];
                $obj->query("SELECT empresa.Empresa, archivos.Logo FROM empresa
                      INNER JOIN usuario on empresa.ID_empresa=usuario.ID_usuario
                      INNER JOIN archivos ON empresa.ID_dtl_empresa=archivos.ID_archivo
                      WHERE ID_usuario=$id");
                $datacard = $obj->resultSet();
        
                $htmlDiv = "
                <div class=\"col-sm-6 col-xl-3 mb-3\" id=\"modal_generada\">
                    <div class=\"card card-span shadow py-4 h-100 border-top border-4 border-primary\">
                      <div class=\"card-body\">
                        <div class=\"text-center\"><img src=\"../php/" . $datacard[0]['Logo'] . "\" width=\"220px\" alt=\"...\">
                          <h5 class=\"my-3\">" . $datacard[0]['Empresa'] . "</h5>
        
                        </div>
                      </div>
                      <div class=\"border-top bg-white text-center pt-3 pb-0\" >
                      <input id=\"provedorID$id\" name=\"provedorID$id\" type=\"hidden\" value=\"$id\">
                      <a class=\"btn btn-primary cardbtn\" href=\"#\"data-bs-toggle=\"modal\" id=\"$id\" data-bs-target=\"infoModalProveedor\">Saber más</a>
                      </div>                        
                    </div>
                  </div>";
                echo $htmlDiv;
            }
            ?>
      </div>
    </div>



  </section>


  <!------------------------------ Modal ------------------------------>
  <div class="modal fade" id="modalInfoProvedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoModalProveedor">Informacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form class="row g-3">
              <div class="row">
                <div class="col-sm-6 form-control-plaintext">Nombre de la empresa</div>
              </div>
              <div class="col-auto" style="margin-right: 15px;">
                <div class="input-group">
                  <div class="input-group-text">Tel:</div>
                  <input type="text" class="form-control" value="55-555-555-55" style="width: 135px;" readonly>
                </div>
              </div>
              <div class="col-auto" style="margin-right: 15px;">
                <div class="input-group">
                  <div class="input-group-text">Ext:</div>
                  <input type="text" class="form-control" value="0259" readonly style="width: 100px;">
                </div>
              </div>
              <div class="col-auto">
                <div class="input-group">
                  <div class="input-group-text">Sitio Web: </div>
                  <input type="text" class="form-control" style="width: 240px;" value="www.wefe.com.mx" readonly>
                </div>
              </div>
              <div class="col-12">
                <label for="inputAddress">Dirección:</label>
                <input type="text" class="form-control" id="inputAddress" value="Sur 25 Mz. 7 Leyes de Reforma"
                  readonly>
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="inputCity" value="CDMX" readonly>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Estado</label>
                <input type="text" class="form-control" id="inputCity" value="CDMX" readonly>
              </div>
              <div class="col-md-2">
                <label for="inputZip" class="form-label">Codigo Postal</label>
                <input type="text" class="form-control" id="inputZip" value="09310" readonly>
              </div>
              <div class="col-md-3">
                <label for="inputVentas" class="form-label">Ventas Anuales</label>
                <input type="text" class="form-control" id="inputVentas" value="$450,000" readonly>
              </div>
              <div class="col-md-4">
                <label for="inputNumE" class="form-label">Numero de empleados </label>
                <input type="text" class="form-control" id="inputNumE" value="500" readonly>
              </div>
              <div class="col-12">
                <label for="txtA_desc">Descripcion de la empresa:</label>
                <textarea class="form-control" name="" id="" cols="12" rows="3" readonly></textarea>
              </div>
              <div class="col-md-4">
                <label for="inputNumE" class="form-label">Presentacion</label>
                <a href="../php/" target="_blank" id="docPresentacion" rel="noopener noreferrer">FILE</a>
              </div>
              <div class="col-12">
                <label for="" class="form-label">Exportaciones</label>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Pais</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td colspan="2">La chingada</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td colspan="2">La Berga</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-12">
                <label for="" class="form-label">Productos</label>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Producto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td colspan="2">Taquitos al pastor</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Certificaciones</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Contactar</button>
        </div>
      </div>
    </div>
  </div>
  <!------------------------------ Fin Modal ------------------------------>
  <!-- FOOTER -->
  <!-- FOOTER -->
  <!-- FOOTER -->
  <!-- FOOTER -->


  <footer>
    <div class="subsribe-section">
      <div class="container">
        <div class="inside-part-footer float-start">
          <div class="d-lg-flex align-items-center">
            <div class="col-lg-7">
              <h2 data-aos="fade-down"> Costo $5,000 más IVA bimestral </h2>
            </div>
            <div class="col-lg-5">
              <a href="#" class="btn started-btn" data-aos="fade-down"> Registro</a>
            </div>
          </div>
        </div>
      </div>
    </div>

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
              <a href="#"> Cerrar sesión </a>
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