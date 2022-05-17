<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
  header("location: /Login.html");
 }else{
  $id_usr=$_SESSION['id_usuario'];
include_once "php/Conexion.php";  
  $obj=new Conexion;                               
  $obj-> query("SELECT * FROM usuario WHERE id_usuario=$id_usr");
  $respuesta= $obj -> resultSet();
  
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

  
<div class="toast-container position-absolute p-3 top-50 start-50 translate-middle"   style="z-index: 11">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      
      <strong class="me-auto">Actualizar Contraseña</strong>
      
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <span>¿Estas seguro de actualizar tu contraseña?</span>
      <span><?php echo $respuesta[0]['usuario'] ?></span>
      <div class="mt-2 pt-2 border-top">
      <button type="button" class="btn btn-primary btn-sm" id="btnToastCambiar">Cambiar</button>
      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Cerrar</button>
    </div>
    </div>
  </div>
</div>
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
                     <li class="ms-3"> <a href="terms.html"> Terminos-condiciones </a>  </li>
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
            <img src="images/LOGO NAVBAR 2.png" class="d-none d-lg-block " alt="logo"/>
          </a>
          <a class="navbar-toggler" data-bs-toggle="offcanvas" href="#mboile-show-menu" role="button" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  
              <li class="nav-item">
                <a class="nav-link" href="#"> Inicio</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Requerimientos</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Proveedores</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="#">Regístrate</a> </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Ingresar
                </a>
                <ul class="dropdown-menu dropdown-menu1" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#"> <i class="fas fa-angle-right"></i>Login proveedor</a></li>
                  <li><a class="dropdown-item" href="#"> <i class="fas fa-angle-right"></i> Login comprador </a></li>
                </ul> </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Aviso de privacidad</a> </li>    
              <li class="nav-item">
                <a class="nav-link" href="#">Realizar pago</a> </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contacto</a></li>
              
 
              <li class="nav-item d-none">
               <p class="phon-text text-white"><i class="fas fa-phone-alt"></i> 555 234-8765 </p>
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
      
       <img src="images/pexels-photo-5580135.jpeg" alt="pb"/>
        

    </div>
 </div>

 <section class="main-body pt-5 float-start industry-pages">
    
      



                <!-- CONTENEDOR DE ELEMENTOS-->
                <!-- COLOCAR CONTENIDO AQUÍ-->
                <!-- COLOCAR CONTENIDO AQUÍ-->
                <!-- COLOCAR CONTENIDO AQUÍ-->
                <!-- COLOCAR CONTENIDO AQUÍ-->




                <div class="container mb-4 text-center">
                    <!-- ENCABEZADOS-->
                    <h4>CUENTA - PROVEEDOR</h4>
                    <a class="text-decoration-none" href="/PaginaprincipalDeProveedores.php">Regresar al Menu Principal</a>
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
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $respuesta[0]['usuario'];?>" disabled >
                              </div>
                               <!-- LABEL 2 -->
                              <div class="col-lg-6 mx-auto mt-3">                              
                                <input type="password" class="form-control" name="password" placeholder="Password" >
                              </div>  
                               <!-- LABEL 3 -->
                              <div class="col-lg-6 mx-auto mt-3">                      
                                <input type="password" class="form-control" name="password2" placeholder="Confirmar Password" >
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
                <!-- OPCIONES CON MODALES -->
                <!-- OPCIONES CON MODALES -->
                <!-- OPCIONES CON MODALES -->
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
                <a href="#" class="btn btn-success"data-bs-toggle="modal" data-bs-target="#exampleModal"> <span>Visualizar</span></a>

                </div>


                <!-- CERTIFICACIONES -->
                <div class="container text-center">

                  <div class="row g-3 mt-2 mb-2">
                      <div class="col-sm">
                        <p>Certificaciones:</p>
                      </div>
                      <div class="col-sm">
                          <!-- BOTON ACTIVA MODAL #2-->
              <a href="#" class="btn btn-success"data-bs-toggle="modal" data-bs-target="#exampleModal2"> <span>Visualizar</span></a>

              </div>




              <!-- COMERCIO EXTERIOR -->
              <div class="container text-center">

                <div class="row g-3 mt-2 mb-2">
                    <div class="col-sm">
                      <p>Comercio exterior:</p>
                    </div>
                    <div class="col-sm">
                        <!-- BOTON ACTIVA MODAL #3-->
            <a href="#" class="btn btn-success"data-bs-toggle="modal" data-bs-target="#exampleModal3"> <span>Visualizar</span></a>

            </div>

          </div>
        </div>


                    




                </div>
              

              <!-- Modal1 -->
              <!-- Modal1 -->
              <!-- Modal1 -->
              <!-- Modal1 -->
              <!-- Modal1 -->


              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DATOS GENERALES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
  
  
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
  
  
                <div class="modal-body">
                
                    <form>
    
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Nombre de la empresa</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Escriba aquí">
                      </div>
    
                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput2">Sede central</label>
                        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Escriba aquí">
                      </div>
    
                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput3">Ubicación</label>
                        <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Escriba aquí">
                      </div>
    
                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput4">Número de empleados</label>
                        <input type="number" class="form-control" id="exampleFormControlInput4" placeholder="Escriba aquí">
                      </div>
    
                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput5">Teléfono</label>
                        <input type="tel" class="form-control" id="exampleFormControlInput5" placeholder="Escriba aquí">
                      </div>
    
                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput6">Website</label>
                        <input type="text" class="form-control" id="exampleFormControlInput6" placeholder="Escriba aquí">
                      </div>

                      <div class="form-group mt-3">
                        <label for="exampleFormControlInput6">Visión del negocio</label>
                        <input type="text" class="form-control" id="exampleFormControlInput7" placeholder="Escriba aquí">
                      </div>

                      <div class="form-group mt-3">
                        <label class="mb-1" for="exampleFormControlInput6">Logo - tamaño máximo 5MB en tamaño PDF</label>
                        <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        
                      </div>
    
    
                      
                    </form>
                  
                
                
                  </div>
                       
                
  
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->

                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <a class="btn btn-primary" href="#">Contactar</a>
                  </div>
                  </div>
                  </div>
                  </div>
                   <!-- END MODAL 1 -->
                   <!-- END MODAL 1-->
                   <!-- END MODAL  1-->




                   <!-- Modal2 -->
              <!-- Modal2 -->
              <!-- Modal2 -->
              <!-- Modal2 -->
              <!-- Modal2 -->


              <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CERTIFICACIONES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
  
  
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
  
  
                <div class="modal-body">
                
                    <form>
    
                      <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Certificaciones</label>
                        
                          
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escriba aquí"></textarea>
                        
                      </div>
    
                      
    
    
                      
                    </form>
                  
                
                
                  </div>
                       
                
  
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->

                <div class="modal-footer mt-3">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <a class="btn btn-primary" href="#">Guardar</a>
                  </div>
                  </div>
                  </div>
                  </div>
                   <!-- END MODAL 2 -->
                   <!-- END MODAL 2-->
                   <!-- END MODAL 2-->



                    <!-- Modal 3-->
              <!-- Modal 3-->
              <!-- Modal 3-->
              <!-- Modal 3-->
              <!-- Modal 3-->


              <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comercio exterior</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
  
  
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- ELEMENTOS CONTENIDOS EN EL MODAL -->
  
  
                <div class="modal-body">
                  <label for="exampleFormControlInput4">Exportaciones A</label>
                  <select class="form-control mb-3">
                    
                    <option>Países</option>
                    <option>Opción 1</option>
                    <option>Opción 2</option>
                    <option>Opción 3</option>
                    <option>Opción 4</option>
                  </select> 
                  <a class="btn btn-primary mb-3" href="#">Guardar</a> 
                
                    <div class="card">
                        <!-- TITULO DE LA CARD -->
                        <h5 class="card-header">Exportación A</h5>
                        
                        <!-- CUERPO DE LA CARD -->
                        <div class="card-body">
                            <!-- TAGS - CONTENIDO DE LA CARD -->

                            <span class="badge bg-primary">TAG x</span>
                            <span class="badge bg-primary">TAG x</span>
                            <span class="badge bg-primary">TAG x</span>
                            <span class="badge bg-primary">TAG x</span>
                            <span class="badge bg-primary">TAG x</span>
                            <span class="badge bg-primary">TAG x</span>
                          
                          
                          
                        </div>
                      </div>
              
                      
              
                </div>
                
  
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
                <!-- FIN ELEMENTOS CONTENIDOS EN EL MODAL -->
  
                <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="#">Guardar</a>
                </div>
                </div>
                </div>
                </div>
                 <!-- END MODAL 3 -->
                 <!-- END MODAL 3-->
                 <!-- END MODAL 3-->
        
 
                
     
      <!-- FINAL DEL CONTENEDOR -->
      <!-- FINAL DEL CONTENEDOR -->
      <!-- FINAL DEL CONTENEDOR -->
      <!-- FINAL DEL CONTENEDOR -->
      <!-- FINAL DEL CONTENEDOR -->
      <!-- YA NO COLOQUE ELEMENTOS :) -->
     
      
 </section>


    <!-- FOOTER -->
   <!-- FOOTER -->
   <!-- FOOTER -->
   <!-- FOOTER -->


   <footer>
    

    <div class="footer-link-div float-start pt-5">
        <div class="container">
           <div class="row row-cols-2 row-cols-md-2  row-cols-lg-4">
              <div class="col-6">
                 <div class="comon-footer-div pt-4">
                     <a href="#">
                        <img src="images/logo-white.png" alt="logo"/>
                     </a>
                    <h6 class="ft-call"> +52 55 55614048</h6>
                    <p class="text-white">  esupplier@clautedomex.mx</p>
                 </div></div>
              <div class="col">
                <div class="comon-footer-div pt-4 justify-content-md-end d-grid">
                    <h5 class="text-white"></h5>
                    <ul class="list-unstyled mt-4">
                      <li><a href="https://www.facebook.com/clautedomex/"> <i class="fab fa-facebook-f"></i> Facebook </a></li>
                      <li><a href="https://twitter.com/clautedomex?s=11&t=jkgi23i_1DQyFLRqNnsV_w"> <i class="fab fa-twitter w"></i>Twitter </a></li>
                      <li><a href="https://instagram.com/clautedomex?igshid=YmMyMTA2M2Y="> <i class="fab fa-instagram"></i> Instagram </a></li> 
                      <li><a href="https://www.linkedin.com/in/cluster-automotriz-estado-de-m%C3%A9xico-515b1913b"> <i class="fab fa-linkedin"></i>linkedin </a></li>
                      </ul></div>  </div></div>             
           <hr/>
            <div class="d-lg-flex justify-content-between">
              <p class="text-white"> Copyright © 2022</p>
              <div class="link-ft">
                 <a href="#" class="ms-lg-3"> Aviso de privacidad </a>
              </div> </div> </div></div>
 </footer>

 <!-- modaible menu -->

 <div class="offcanvas offcanvas-start mobile-menu-div" tabindex="-1" id="mboile-show-menu" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <button type="button" class="close-menu" data-bs-dismiss="offcanvas" aria-label="Close">
      <span> Close </span> <i class="fas fa-long-arrow-alt-right"></i>
     </button>
  </div>
  <div class="offcanvas-body">
    <div class="head-contact">
      <a href="index.html" class="logo-side">
      <img src="images/logo-main.png" alt="logo">
      </a>
     
      <div class="mobile-menu-sec mt-3">
         <ul class="list-unstyled">
            <li class="active-m">
               <a href="index.html"> Home </a>
            </li>
            <li>
               <a href="about.html"> About </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Services
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="mechanical-works.html">Mechanical Works</a></li>
                <li><a class="dropdown-item" href="manufacturing.html"> Manufacturing </a></li>
                <li><a class="dropdown-item" href="storage.html"> Consulting Storage </a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Industries
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="automotive.html"> Automotive </a></li>
                <li><a class="dropdown-item" href="manufacturings.html">  Manufacturing  </a></li>
                <li><a class="dropdown-item" href="technology.html">  Technology </a></li>
              </ul>
            </li>
            <li>
               <a href="case-study.html">  Case Study  </a>
            </li>
            <li>
               <a href="leadership.html"> leadership  </a>
            </li>
            <li>
              <a href="partners.html">  Partners   </a>
            </li>
            <li>
              <a href="career.html"> Career  </a>
            </li>
            <li>
             <a href="contact.html"> Contact  </a>
            </li>
         </ul>
      </div>
      
      <ul class="side-media list-unstyled">
         <li> <a href="#"> <i class="fab fa-facebook-f"></i> </a> </li>
         <li> <a href="#"> <i class="fab fa-twitter"></i> </a> </li>
         <li> <a href="#"> <i class="fab fa-google-plus-g"></i> </a> </li>
         <li> <a href="#"> <i class="fab fa-instagram"></i> </a> </li>
      </ul>
    </div>
  </div>
</div>


<!-- Back to top button -->
<!-- Back to top button -->
<!-- Back to top button -->
<button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
        >
  <i class="fas fa-arrow-up"></i>
</button>

<!-- END BACK TO TOP BUTTON -->






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
