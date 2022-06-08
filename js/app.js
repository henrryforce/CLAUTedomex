/**
 * evento de escucha de carga del DOM para cargar eventos cuando este totalmente cargado
 */
document.addEventListener("DOMContentLoaded", load);
/**
 * funcion para cargar eventos en la pagina e identificar en que archivo html estamos
 */
function load() {
  let ubi = document.body.baseURI;
  document.addEventListener("click",function (e){
    if(e.target.className.includes('logout')){
      logout();
    }
    
  });
  if (ubi.includes("/Login.html")) {
    document.getElementById("btnlogin").addEventListener("click", enviaLogin);
  }
  if (ubi.includes("/reestablecercontrasena1.html")) {
    document
      .getElementById("btnResetPass")
      .addEventListener("click", resetPassword);
  }
  if (ubi.includes("/Registrate.html")) {
    document
      .getElementById("btnaceptar")
      .addEventListener("click", enviarRegistro);
  }
  if (ubi.includes("/confirmarregistro1.html")) {
    let redireccionado = localStorage.getItem("Preregistro");
    let email = localStorage.getItem("email");
    if (redireccionado === "1") {
      let divCode = document.getElementById("preRegistro");
      let h6 = document.getElementById("modificable");
      h6.innerText = "El codigo se envio al correo " + email;
      let a = document.createElement("h6");
      a.innerText = "Reenviar Código";
      a.id = "reenvia";
      a.className =
        "text-dark font-weight-regular text-decoration-none text-decoration-underline";
      divCode.appendChild(a);
      document
        .getElementById("reenvia")
        .addEventListener("click", reenviarCode);
      function reenviarCode() {
        let data = new FormData();
        data.append("email", localStorage.getItem("email"));
        data.append("reenvio", 0);
        fetch("../php/registro.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .then((data) => {
            var noti = document.getElementById("notificacion");
            if (data === "enviado") {
              creaNotificacion(noti, "Codigo Reenviado");
            } /*else {
              window.location.assign('/confirmarregistro2.html')
            }*/
          });
      }
    }
    document
      .getElementById("btnconfirmar")
      .addEventListener("click", confirmarEmail);
  }
  if (ubi.includes("/confirmarregistro2.html")) {
    setTimeout(() => {
      window.location.assign("/Login.html");
    }, 1000);
  }
  if (ubi.includes("/reestablecercontrasena2.html")) {
    document
      .getElementById("resetPass")
      .addEventListener("click", codeResetPass);
  }
  if (ubi.includes("/reestablecercontrasena3.html")) {
    document
      .getElementById("btnNewPass")
      .addEventListener("click", cambiarPass);
  }
  if (ubi.includes("/reestablecercontrasena4.html")) {
    setTimeout(() => {
      window.location.assign("/Login.html");
    }, 1000);
  }
  if (ubi.includes("/PaginaprincipalDeProveedores.php")) {
    document
      .getElementById("btnAdminPerfil")
      .addEventListener("click", AdminPerfilProveedor);
    document.getElementById("comodity").addEventListener("change", getval);
    document.getElementById("logout").addEventListener("click", logout);
    document.getElementById("logout2").addEventListener("click", logout);
  }
  if (ubi.includes("/PaginaprincipalDeTractoras.php")) {
    document.getElementById("comodity").addEventListener("change", getval);
    document
      .getElementById("btnAdministrarcuenta")
      .addEventListener("click", (_) => {
        window.location.assign("/cuenta-tractora.php");
      });
  }
  if (ubi.includes("/contact.html")) {
    document
      .getElementById("btnContacto")
      .addEventListener("click", contactoform);
  }
  if (ubi.includes("/cuenta-proveedor.php")) {
    document
      .getElementById("btnPassword")
      .addEventListener("click", changePassPerfilProveedor);
    document
      .getElementById("btnDatosGenerales")
      .addEventListener("click", updateDatosproveedor);
    document.getElementById("btnCerts").addEventListener("click", sendCerts);
    document
      .getElementById("btnagregarpaises")
      .addEventListener("click", AgregaPaisCombo);
    document
      .getElementById("btnSavePais")
      .addEventListener("click", agregarPais);
    document.getElementById("listaPaises").addEventListener("click", borraPais);
    document
      .getElementById("btnEnviar")
      .addEventListener("click", enviarPaises);
    document.getElementById("logout").addEventListener("click", logout);
    fetch("../php/gestorcuenta.php?expo=501", {
      method: "GET",
    })
      .then((res) => res.json())
      .then((data) => {
        if (data[0]["pais"] != null) {
          let paises = data[0]["pais"].split(",");
          localStorage.setItem("PaisesExp", JSON.stringify(paises));
        }
      });
  }
  if (ubi.includes("/cuenta-tractora.php")) {
    document
      .getElementById("btnDatosGenerales")
      .addEventListener("click", updateDatosproveedor);
    document
      .getElementById("btnagregarpaises")
      .addEventListener("click", AgregaPaisCombo);
    document
      .getElementById("btnPassword")
      .addEventListener("click", changePassPerfilProveedor);
    document.getElementById("logout").addEventListener("click", logout);
    document.getElementById("btnCerts").addEventListener("click", sendCerts);
    document.getElementById("listaPaises").addEventListener("click", borraPais);
    document
      .getElementById("btnSavePais")
      .addEventListener("click", agregarPais);
    document
      .getElementById("btnEnviar")
      .addEventListener("click", enviarPaises);
    fetch("../php/gestorcuenta.php?expo=501", {
      method: "GET",
    })
      .then((res) => res.json())
      .then((data) => {
        if (data[0]["pais"] != null) {
          let paises = data[0]["pais"].split(",");
          localStorage.setItem("PaisesExp", JSON.stringify(paises));
        }
      });
  }
  if (ubi.includes("/Busquedaproveedores.php")) {
    
    document.addEventListener("click", function (e) {
      //un evento en el dom completo sobre click ya que no sabemos cuantas cards se pueden generar
      if (e.target.className == "btn btn-primary cardbtn") {
        //verificamos que el objeto clickeado tenga cla clase que nos interesa
        document.getElementById("DatosContacto").classList.add("d-none");
        let id = e.target.parentElement.firstElementChild.value; //obtenemos el papa del elemento clickeado luego su primer hijo que es el input con el id
        localStorage.setItem("idCard", id);
        let noti = document.getElementById("notificaciones");
        let data = new FormData(); //se crea un form data para los datos
        data.append("id", id); //agregamos el ID
        data.append("getData", 1); //variable de control y hacemos fetch
        fetch("../php/listarproveedores.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .then((data) => {
            document.getElementById("nomProv").innerText = data[0]["Empresa"];
            document
              .getElementById("mtel")
              .setAttribute("value", data[0]["Tel"]);
            document
              .getElementById("mwebsite")
              .setAttribute("value", data[0]["Pagina_web"]);
            document
              .getElementById("mExt")
              .setAttribute("value", data[0]["Ext"]);
            document
              .getElementById("mAddress")
              .setAttribute(
                "value",
                data[0]["Calle"] +
                  " " +
                  data[0]["N_Ext"] +
                  " " +
                  data[0]["N_Int"] +
                  ", " +
                  data[0]["Colonia"]
              );
            document
              .getElementById("inputCity")
              .setAttribute("value", data[0]["Alcaldia"]);
            document
              .getElementById("inputEstado")
              .setAttribute("value", data[0]["estado"]);
            document
              .getElementById("inputCP")
              .setAttribute("value", data[0]["CP"]);
            document
              .getElementById("inputVentas")
              .setAttribute("value", "$" + data[0]["Ventas_anuales"]);
            document
              .getElementById("inputNumE")
              .setAttribute("value", data[0]["Num_empleados"]);
            document.getElementById("txtempresa").value =
              data[0]["Descripcion"];
            setLink(
              data[0]["Presentacion"],
              document.getElementById("docPresentacion")
            );
            document
              .getElementById("exports")
              .setAttribute("value", noNull(data[0]["paisesExporta"]));
            document
              .getElementById("certs")
              .setAttribute("value", noNull(data[0]["listaCerts"]));
            setLink(data[0]["path"], document.getElementById("docCerts"));
          });
        data = new FormData();
        data.append("id", id); //agregamos el ID
        data.append("getProductos", 1); //variable de control y hacemos fetch
        fetch("../php/listarproveedores.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .then((data) => {
            //console.log(data);
            let tabla = document.getElementById("tableBodyModal");
            let cat = [
              "Producto",
              "Proceso",
              "Materia prima",
              "Servicios indirectos",
            ];
            tabla.innerHTML = "";
            data.forEach((registro) => {
              let tr = document.createElement("tr");
              let tdID = document.createElement("td");
              tdID.innerText = cat[registro["ID_catalogo"] - 1];
              let tdProducto = document.createElement("td");
              tdProducto.innerText = registro["Producto"];
              tr.appendChild(tdID);
              tr.appendChild(tdProducto);
              tabla.appendChild(tr);
            });
          });
      }


      if(e.target.className == "form-control comboComodity"){  
       
        let data = new FormData();
        /**les quitamos la clase d-none a todas las carts */
        if(e.target.options[e.target.selectedIndex].value == 'none'){
          let carts = document.querySelectorAll('.cartconteiner');
          carts.forEach(cart =>{
            cart.classList.remove("d-none");
          });
        }
        if(e.target.options[e.target.selectedIndex].value != 'none'){          
          data.append("tipoCat",e.target.options[e.target.selectedIndex].value);
          data.append("getFiltar",1);
          fetch("../php/listarproveedores.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.json())
            .then((data) => {
              console.log(data);
              let idsDelete=[];
              data.forEach(elemnt =>{
                idsDelete.push(elemnt['id']);
              });
              idsDelete = new Set(idsDelete);
              idsDelete.forEach(id=>{
                console.log(id);
                function limpiarDisplay(){
                  document.getElementById('cartProveedor'+id).classList.remove("d-none");
                }
                document.getElementById('exampleFormControlSelect1').onclick=function(){
                  limpiarDisplay();
                }
                document.getElementById('cartProveedor'+id).classList.add("d-none");                
              });
              });
        }        
      }
    });
    document
      .getElementById("btnContactar")
      .addEventListener("click", contactoProveedor);
  }

  if (ubi.includes("/Busquedatractoras.php")) {
    document.getElementById("logout").addEventListener("click", logout);
    document.addEventListener("click", function (e) {
      //un evento en el dom completo sobre click ya que no sabemos cuantas cards se pueden generar
      if (e.target.className == "btn btn-primary cardbtn") {
        //verificamos que el objeto clickeado tenga cla clase que nos interesa
        document.getElementById("DatosContacto").classList.add("d-none");
        let id = e.target.parentElement.firstElementChild.value; //obtenemos el papa del elemento clickeado luego su primer hijo que es el input con el id
        console.log(id);
        localStorage.setItem("idCard", id);
        let noti = document.getElementById("notificaciones");
        let data = new FormData(); //se crea un form data para los datos
        data.append("id", id); //agregamos el ID
        data.append("getDataT", 1); //variable de control y hacemos fetch

        fetch("../php/listarRequerimientos.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .then((data) => {
            console.log(data);
            document.getElementById("nomProv").innerText = data[0]["Empresa"];
            document
              .getElementById("mtel")
              .setAttribute("value", data[0]["Tel"]);
            document
              .getElementById("mwebsite")
              .setAttribute("value", data[0]["Pagina_web"]);
            document
              .getElementById("mExt")
              .setAttribute("value", data[0]["Ext"]);
            document
              .getElementById("mAddress")
              .setAttribute(
                "value",
                data[0]["Calle"] +
                  " " +
                  data[0]["N_Ext"] +
                  " " +
                  data[0]["N_Int"] +
                  ", " +
                  data[0]["Colonia"]
              );
            document
              .getElementById("inputCity")
              .setAttribute("value", data[0]["Alcaldia"]);
            document
              .getElementById("inputEstado")
              .setAttribute("value", data[0]["estado"]);
            document
              .getElementById("inputCP")
              .setAttribute("value", data[0]["CP"]);
            document
              .getElementById("inputVentas")
              .setAttribute("value", "$" + data[0]["Ventas_anuales"]);
            document
              .getElementById("inputNumE")
              .setAttribute("value", data[0]["Num_empleados"]);
            document.getElementById("txtempresa").value =
              data[0]["Descripcion"];
            setLink(
              data[0]["Presentacion"],
              document.getElementById("docPresentacion")
            );
            document
              .getElementById("exports")
              .setAttribute("value", noNull(data[0]["paisesExporta"]));
            document
              .getElementById("certs")
              .setAttribute("value", noNull(data[0]["listaCerts"]));
            setLink(data[0]["path"], document.getElementById("docCerts"));
          });
        data = new FormData();
        data.append("id", id); //agregamos el ID
        data.append("getRequerimiento", 1); //variable de control y hacemos fetch
        fetch("../php/listarRequerimientos.php", {
          method: "POST",
          body: data,
        })
          .then((res) => res.json())
          .then((data) => {
            //console.log(data);
            let tabla = document.getElementById("tableBodyModal");
            let cat = [
              "Producto",
              "Proceso",
              "Materia prima",
              "Servicios indirectos",
            ];
            tabla.innerHTML = "";
            data.forEach((registro) => {
              let tr = document.createElement("tr");
              let tdID = document.createElement("td");
              tdID.innerText = cat[registro["ID_req_producto"] - 1];
              let tdProducto = document.createElement("td");
              tdProducto.innerText = registro["Producto"];
              let tdTmateriales = document.createElement("td");
              tdTmateriales.innerText = registro["Tipo_material"];
              let tdVolumen = document.createElement("td");
              tdVolumen.innerText = registro["Volumen_anual"];
              let tdComentarios = document.createElement("td");
              tdComentarios.innerText = registro["Comentarios"];
              tr.appendChild(tdID);
              tr.appendChild(tdProducto);
              tr.appendChild(tdTmateriales);
              tr.appendChild(tdVolumen);
              tr.appendChild(tdComentarios);
              tabla.appendChild(tr);
              //console.log(registro);
            });
          });
    }
    if(e.target.className == "form-control comboComodity"){
      let data = new FormData();
      if(e.target.options[e.target.selectedIndex].value == 'none'){
        let carts = document.querySelectorAll('.cartconteiner');
        carts.forEach(cart =>{
          cart.classList.remove("d-none");
        });
      }
      if(e.target.options[e.target.selectedIndex].value != 'none'){
        
        data.append("tipoCatT",e.target.options[e.target.selectedIndex].value);
        data.append("getFiltarT",1);
        fetch("../php/listarRequerimientos.php", {
          method: "POST",
          body: data,
        })
        .then((res) => res.json())
            .then((data) => {
              console.log(data);
              let idsDelete=[];
              data.forEach(elemnt =>{
                idsDelete.push(elemnt['id']);
              });
              idsDelete = new Set(idsDelete);
              idsDelete.forEach(id=>{
                console.log(id);
                function limpiarDisplay(){
                  document.getElementById('cartProveedor'+id).classList.remove("d-none");
                }
                document.getElementById('exampleFormControlSelect1').onclick=function(){
                  limpiarDisplay();
                }
                document.getElementById('cartProveedor'+id).classList.add("d-none");
              });
              });
    }
  }
  });
  document.getElementById('btnContactar').addEventListener("click",contactoTractora);
  }
}

/**
 *
 *
 *
 */
function enviaLogin(e) {
  e.preventDefault();
  let form = document.getElementById("loginform");
  let data = new FormData(form);
  let noti = document.getElementById("notificacion");
  if (data.get("email") == "" && data.get("password") == "") {
    creaNotificacion(noti, "Debes llenar todos los campos");
  } else {
    fetch("../php/login.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data === "Bad email") {
          creaNotificacion(noti, "El correo no esta registrado");
        }
        if (data === "Sin Verificar") {
          creaNotificacion(
            noti,
            "El correo no esta verificado seras redireccionado en breve"
          );
          localStorage.setItem("email", document.getElementById("email").value);
          localStorage.setItem("Preregistro", 1);
          setTimeout(() => {
            window.location.assign("/confirmarregistro1.html");
          }, 1500);
        }
        if (data === "Incorrecta") {
          creaNotificacion(noti, "Contraseña incorrecta");
        }
        if (data.toString() === "2") {
          window.location.assign("/PaginaprincipalDeProveedores.php");
        }
        if (data.toString() === "1") {
          window.location.assign("/PaginaprincipalDeTractoras.php");
        }
      });
  }
}
/**
 * Funcion para generar el registro
 */
function enviarRegistro(e) {
  const exprecionRegular =
    /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
  e.preventDefault();
  let form = document.getElementById("formRegistro");
  let data = new FormData(form);
  let notifica = document.getElementById("notificaciones");

  if (data.get("password") !== data.get("password_confirm")) {
    //        notifica.innerHTML=`<p>Las contraseñas no coinciden</p>`;
    creaNotificacion(notifica, "Las contraseñas no coinciden");
  }
  if (data.get("nom_empresa") === "") {
    creaNotificacion(notifica, "El nombre de la empresa es obligatorio");
  }
  if (data.get("password") === "" && data.get("password_confirm") === "") {
    creaNotificacion(notifica, "Debes ingresar una contraseña y confirmarla");
  }
  if (data.get("email") === "") {
    creaNotificacion(notifica, "Debes ingresar un email");
  }
  if (data.get("usertype") === null) {
    creaNotificacion(notifica, "Debes seleccionar un tipo de usuario");
  }
  if (!exprecionRegular.test(data.get("password"))) {
    creaNotificacion(
      notifica,
      "La contraseña no cumple con los criterios minimos de seguridad debe contener al menos 1 mayúscula, 1 minúscula, 1 dígito, 1 carácter especial y tiene una longitud de al menos 8"
    );
  }

  if (
    data.get("password") === data.get("password_confirm") &&
    data.get("nom_empresa") !== "" &&
    data.get("email") !== "" &&
    data.get("usertype") !== null &&
    exprecionRegular.test(data.get("password"))
  ) {
    /*for (var a of data.values()) {
      console.log(a);
    }*/
    localStorage.setItem("email", data.get("email"));
    fetch("../php/registro.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data == 401) {
          creaNotificacion(notifica, "El correo ya existe");
        }
        if (data == 201) {
          window.location.assign("./confirmarregistro1.html");
        }
      });
  }
}
function confirmarEmail(e) {
  e.preventDefault();
  let form = document.getElementById("formConfirmarEmail");
  let data = new FormData(form);
  let email = localStorage.getItem("email");
  data.append("email", email);
  localStorage.setItem("code", data.get("codigo"));
  fetch("../php/registro.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      var noti = document.getElementById("notificacion");
      if (data === "Codigo erroneo") {
        creaNotificacion(noti, "Codigo Erroneo Vuelve a intentarlo");
      } else {
        localStorage.setItem("Preregistro", 0);
        window.location.assign("/confirmarregistro2.html");
      }
    });
  form.reset();
}
function resetPassword(e) {
  e.preventDefault();
  let form = document.getElementById("formResetPass");
  let noti = document.getElementById("notificaciones");
  let data = new FormData(form);
  data.append("restablecer", 1);
  if (data.get("email") === "") {
    creaNotificacion(noti, "No puedes dejar el campo Vacio");
  } else if (!data.get("email").includes("@")) {
    creaNotificacion(noti, "Correo invalido @ no detectado");
  } else {
    fetch("../php/login.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data === "Bad email") {
          creaNotificacion(noti, "No existe el correo en la Base de Datos");
        } else if (data === "Sin Verificar") {
          creaNotificacion(
            noti,
            "Correo sin verificar sera redirigido en breve"
          );
          localStorage.setItem("email", document.getElementById("email").value);
          localStorage.setItem("Preregistro", 1);
          setTimeout(() => {
            window.location.assign("/confirmarregistro1.html");
          }, 1500);
        } else if (data === "OK") {
          localStorage.setItem("email", document.getElementById("email").value);
          window.location.assign("reestablecercontrasena2.html");
        }
      });
  }
}
/**
 * Validando el Codigo enviado al correo cuando se olvido la contrase
 */
function codeResetPass(e) {
  e.preventDefault();
  let form = document.getElementById("formResetPassC");
  let noti = document.getElementById("notificaciones");
  let data = new FormData(form);
  let email = localStorage.getItem("email");
  data.append("email", email);
  fetch("../php/registro.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data === "Codigo erroneo") {
        creaNotificacion(noti, "Codigo Erroneo Vuelve a intentarlo");
      } else {
        window.location.assign("/reestablecercontrasena3.html");
      }
    });
  form.reset();
}
function cambiarPass(e) {
  e.preventDefault();
  let form = document.getElementById("forNewPass");
  let noti = document.getElementById("notificaciones");
  let data = new FormData(form);
  let email = localStorage.getItem("email");
  data.append("email", email);
  data.append("resetPass", 1);
  if (data.get("password_c") === "" || data.get("password") === "") {
    creaNotificacion(noti, "No puedes dejar  campos en blanco");
  } else if (data.get("password_c") !== data.get("password")) {
    creaNotificacion(noti, "Las contraseñas no coinciden");
  } else if (data.get("password_c").length < 8) {
    creaNotificacion(noti, "La contraseña debe ser de almenos 8 cracteres");
  } else {
    fetch("../php/login.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data === "OK") {
          localStorage.clear();
          window.location.assign("/reestablecercontrasena4.html");
        }
      });
  }
}
/**
 * funcion para administrar el perfil de proveefores
 */
function AdminPerfilProveedor() {
  window.location.assign("/cuenta-proveedor.php");
}
/**
 * Funcion para eliminar los nodos de un elemento padre
 */
function eliminaNodos(padre) {
  setTimeout(() => {
    padre.removeChild(padre.firstElementChild);
    padre.classList.remove("alert-danger");
    padre.classList.remove("alert");
  }, 3500);
}
/**
 * funcion vista contacto
 */
function contactoform(e) {
  e.preventDefault();
  let form = document.getElementById("formContacto");
  let noti = document.getElementById("notificaciones");
  let data = new FormData(form);
  if (data.get("name") === "") {
    creaNotificacion(noti, "Debes agregar un nombre");
  }
  if (data.get("email") === "") {
    creaNotificacion(noti, "Debes agregar un email");
  }
  if (data.get("phone") === "") {
    creaNotificacion(noti, "Debes agregar un telefono de contacto");
  }
  if (data.get("subject") === "") {
    creaNotificacion(noti, "Debes agregar un asunto");
  }
  if (data.get("message") === "") {
    creaNotificacion(noti, "Debes agregar un mensaje");
  }
  if (
    data.get("name") != "" &&
    data.get("email") != "" &&
    data.get("phone") != "" &&
    data.get("subject") != "" &&
    data.get("message") != ""
  ) {
    fetch("../php/contact.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data == "send") {
          form.reset();
          creaNotificacion(noti, "!Formulario enviado con exito¡");
          modificaNotificacion(noti, "alert alert-success");
        } else {
          creaNotificacion(noti, "!Error al enviar el Formulario¡");
        }
      });
  }
}
function changePassPerfilProveedor(e) {
  e.preventDefault();
  const exprecionRegular =
    /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/;
  let form = document.getElementById("formPassword");
  let noti = document.getElementById("notificaciones");
  let data = new FormData(form);
  if (data.get("email") === "") {
    creaNotificacion(noti, "El campo correo no puede estar vacio");
  }
  if (data.get("password") === "") {
    creaNotificacion(noti, "El campo contraseña no puede estar vacio");
  }
  if (data.get("password2") === "") {
    creaNotificacion(
      noti,
      "El campo de confirmacion de contraseña no puede estar vacio"
    );
  }
  if (data.get("password") !== data.get("password2")) {
    creaNotificacion(noti, "Las contraseñas no coinciden");
  }
  if (!exprecionRegular.test(data.get("password"))) {
    creaNotificacion(
      noti,
      "La contraseña no cumple con los criterios minimos de seguridad debe contener al menos 1 mayúscula, 1 minúscula, 1 dígito, 1 carácter especial y tiene una longitud de al menos 8"
    );
  }
  if (
    data.get("email") !== "" &&
    data.get("password") !== "" &&
    data.get("password2") !== "" &&
    data.get("password") === data.get("password2") &&
    exprecionRegular.test(data.get("password"))
  ) {
    var toast = new bootstrap.Toast(document.getElementById("liveToast"));
    document.getElementById("toasContaider").style.zIndex = "11";
    toast.show();
    document.getElementById("btnToastCambiar").addEventListener("click", () => {
      data = new FormData(document.getElementById("formPassword"));
      data.append("cambioPassword", 1);
      console.log(data.get("password"));
      fetch("../php/Gestorcuenta.php", {
        method: "POST",
        body: data,
      })
        .then((res) => res.json())
        .then((data) => {
          console.log(data);
        });
      document.getElementById("formPassword").reset();
      toast.hide();
      creaNotificacion(
        document.getElementById("notificaciones"),
        "Contrasesena actualizada"
      );
      document.getElementById("notificaciones").className =
        "alert alert-success";
    });
  }
}
/*
 * Funcion de Actualizacion de Datos de Proveedor
 */
function updateDatosproveedor(e) {
  e.preventDefault();
  let form = document.getElementById("formDatosGenProveedor");
  let noti = document.getElementById("notificacionesMD");
  let notiF = document.getElementById("notificacionesFiles");
  let data = new FormData(form);

  const jpg = "image/jpeg";
  const png = "image/png";
  const pdf = "application/pdf";
  data.append("actualizarDatos", 1);

  if (data.get("Logo").size == 0 && data.get("presentacion").size == 0) {
    creaNotificacion(notiF, "No cargaste ningun archivo");
  }
  if (
    data.get("Logo").type != jpg &&
    data.get("Logo").type != png &&
    data.get("Logo").size > 0
  ) {
    creaNotificacion(notiF, "Solo se admiten archivos JPG o PNG");
  } else {
    if (data.get("Logo").size > 1048576) {
      creaNotificacion(notiF, "Logo muy pesado");
    }
  }
  if (
    data.get("presentacion").type != pdf &&
    data.get("presentacion").size > 0
  ) {
    creaNotificacion(notiF, "Solo se admiten archivos PDF");
  } else {
    if (data.get("presentacion").size > 1048576) {
      creaNotificacion(notiF, "Presentacion muy pesada");
    }
  }
  if (data.get("presentacion").size == 0 && data.get("Logo").size > 0) {
    creaNotificacion(notiF, "Logo Cargado con exito");
    modificaNotificacion(notiF, "alert alert-success");
  }
  if (
    data.get("presentacion").size > 0 &&
    data.get("presentacion").type == pdf &&
    data.get("Logo").size == 0
  ) {
    creaNotificacion(notiF, "Presentación Cargado con exito");
    modificaNotificacion(notiF, "alert alert-success");
  }
  if (data.get("ext") != "") {
    data.set("ext", 0);
  }
  if (
    data.get("calle") != "" &&
    data.get("num_ext") != "" &&
    data.get("nim_int") != "" &&
    data.get("cp") != "" &&
    data.get("colonia") != "" &&
    data.get("delegacion") != "" &&
    data.get("estados") != "" &&
    data.get("num_emp") != "" &&
    data.get("ventas") != "" &&
    data.get("telefono") != "" &&
    data.get("paginaweb") != "" &&
    data.get("txtnegocio") != ""
  ) {
    fetch("../php/Gestorcuenta.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data == 201) {
          creaNotificacion(
            document.getElementById("notificacionesMD"),
            "Se han enviado los cambios con exito "
          );
          modificaNotificacion(
            document.getElementById("notificacionesMD"),
            "alert alert-success"
          );
          document.getElementById("modalDatosGenerales").scrollTo(0, 0);
        }
      });
  } else {
    creaNotificacion(noti, "Debes agregar todos los datos");
  }
}

/**
 * Funcion commodity get value
 */
function getval(e) {
  //console.log(e.target.value); //Obtener el valor con el evento change sobre el combo id combo cmbProducto
  let data = new FormData(); //creas el form data
  data.append("tipo", e.target.value); // agregas un elemento
  //console.table(typeof(data.get('tipo')));// puedes acceder a el con .get

  fetch("../php/catalogos.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      let combo = document.getElementById("cmbProducto");
      combo.innerHTML = "";
      data.forEach((element) => {
        var opt = document.createElement("option");
        //opt.value = element['id']
        opt.innerHTML = element["producto"];
        combo.appendChild(opt);
      });
    });
}

function sendCerts(e) {
  e.preventDefault();
  const pdf = "application/pdf";
  let form = document.getElementById("certyforms");
  let noti = document.getElementById("notificacionesMC");
  let data = new FormData(form);
  let ubi = document.body.baseURI;
  if(ubi.includes("/cuenta-tractora.php")){
    if (data.get("txtcerts") == "") {
      creaNotificacion(noti, "No puedes dejar el ningun campo en blanco");
    }
    if(data.get("txtcerts") != ""){
      data.append("certTractora", 1);
      
    fetch("../php/gestorcuenta.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
        if (data == 201) {
          creaNotificacion(
            document.getElementById("notificacionesMC"),
            "Se ha agregado con exito"
          );
          modificaNotificacion(
            document.getElementById("notificacionesMC"),
            "alert alert-success"
          );
        }
        if (data == 409) {
          creaNotificacion(
            noti,
            "Ocurrio un error inesperado en la carga del archivo"
          );
          modificaNotificacion(noti, "alert alert-warning");
        }
      });
    }
  }else{
  if (data.get("certdoc").size > 1048576) {
    creaNotificacion(
      noti,
      "Documento muy pesado, solo se permiten archivos de menos de 1mb"
    );
  }
  if (data.get("txtcerts") == "") {
    creaNotificacion(noti, "No puedes dejar el ningun campo en blanco");
  }
  if (data.get("certdoc").size == 0 && data.get("certdoc").name == "") {
    creaNotificacion(noti, "Debes adjuntar un archivo");
  }
  if (data.get("certdoc").type != pdf) {
    creaNotificacion(noti, "Solo puedes adjuntar archivos del tipo PDF");
  }
  if (
    data.get("certdoc").size <= 1048576 &&
    data.get("txtcerts") != "" &&
    data.get("certdoc").name != ""
  ) {
    data.append("cert", 1);
    fetch("../php/gestorcuenta.php", {
      method: "POST",
      body: data,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
        if (data == 201) {
          creaNotificacion(
            document.getElementById("notificacionesMC"),
            "Se ha agregado con exito"
          );
          modificaNotificacion(
            document.getElementById("notificacionesMC"),
            "alert alert-success"
          );
        }
        if (data == 409) {
          creaNotificacion(
            noti,
            "Ocurrio un error inesperado en la carga del archivo"
          );
          modificaNotificacion(noti, "alert alert-warning");
        }
      });
  }
}
}
/**Funcion para agregar paises al combo */
function AgregaPaisCombo(e) {
  e.preventDefault();
  fetch("../php/paises.json")
    .then((response) => response.json())
    .then((jsondata) => {
      pais = [];
      for (key in jsondata) {
        pais.push(jsondata[key]);
      }
      let comboP = document.getElementById("pais");
      pais = pais.sort();
      for (i in pais) {
        var opt = document.createElement("option");
        opt.value = pais[i];
        opt.innerHTML = pais[i];
        comboP.appendChild(opt);
      }
    });
  setPasisesLS();
}
/**Funcion agrega etiquetas modal */
function agregarPais(e) {
  e.preventDefault();
  const divP = document.getElementById("listaPaises");
  let form = document.getElementById("formexport");
  let noti = document.getElementById("notificacionesMP");
  let data = new FormData(form);
  if (data.get("pais") != "0") {
    paisesLS = ObtenerPaisLS();
    if (paisesLS.includes(data.get("pais"))) {
      creaNotificacion(noti, "No puedes agregar el mismo pais 2 veces");
    } else {
      let borrarPais = document.createElement("a");
      borrarPais.classList = "borrar-pais";
      borrarPais.innerText = "X";
      let spanPais = document.createElement("li");
      spanPais.innerText = data.get("pais");
      spanPais.classList = "badge bg-success";
      spanPais.appendChild(borrarPais);
      divP.appendChild(spanPais);
      agregarPaisLS(data.get("pais"));
    }
  } else {
    creaNotificacion(noti, "Debes seleccionar un pais");
  }
}
/**
 * funcion Agregar a Local storage los paises
 */
function agregarPaisLS(pais) {
  let paises;
  paises = ObtenerPaisLS();
  paises.push(pais);
  localStorage.setItem("PaisesExp", JSON.stringify(paises));
}
/**obtener Paises LS */
function ObtenerPaisLS() {
  let paises;
  if (localStorage.getItem("PaisesExp") === null) {
    paises = [];
  } else {
    paises = JSON.parse(localStorage.getItem("PaisesExp"));
  }

  return paises;
}
/**Funcion Borra pais */
function borraPais(e) {
  e.preventDefault();
  if (e.target.className === "borrar-pais") {
    e.target.parentElement.remove();
    borraPaisLS(e.target.parentElement.innerText.replace("X", ""));
  }
  function borraPaisLS(pais) {
    let paises;
    paises = ObtenerPaisLS();
    paises.forEach(function (paisLS, i) {
      if (pais == paisLS) {
        paises.splice(i, 1);
      }
    });
    localStorage.setItem("PaisesExp", JSON.stringify(paises));
  }
}
/**Funcion para setear paises en ls */
function setPasisesLS() {
  const divP = document.getElementById("listaPaises");
  divP.innerHTML = "";
  let paises;
  paises = ObtenerPaisLS();
  paises.forEach(function (pais) {
    const btnborrarP = document.createElement("a");
    btnborrarP.classList = "borrar-pais";
    btnborrarP.innerText = "X";
    const li = document.createElement("li");
    li.classList = "badge bg-success";
    li.innerText = pais;
    li.appendChild(btnborrarP);
    divP.appendChild(li);
  });
}
/**Funcion BD paises */
function enviarPaises(e) {
  e.preventDefault();
  let paises = ObtenerPaisLS();
  data = new FormData();
  data.append("paises", JSON.stringify(paises));
  fetch("../php/gestorcuenta.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data == 201) {
        creaNotificacion(
          document.getElementById("notificacionesMP"),
          "Se guardaron con exito las Exportaciones"
        );
        modificaNotificacion(
          document.getElementById("notificacionesMP"),
          "alert alert-success"
        );
      }
    });
}
/**Contactar Proveedor */

function contactoProveedor() {
  let noti = document.getElementById("notificaciones");
  let datosC = document.getElementById("DatosContacto");
  let data = new FormData();
  data.append("id", localStorage.getItem("idCard"));
  data.append("contactarProv", 1);
  //console.log(data.get("idProv"));
  document.getElementById("modalInfoProvedor").scrollTo(0, 0);
  creaNotificacion(noti, "Datos del proveedor desplegados");
  modificaNotificacion(noti, "alert alert-success");
  datosC.classList.remove("d-none");
  fetch("../php/pruebas.php", {
    method: "POST",
    body: data,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
}

function contactoTractora() {
  let noti = document.getElementById("notificaciones");
  let datosC = document.getElementById("DatosContacto");
  let data = new FormData();
  data.append("idTr", localStorage.getItem("idCard"));
  console.log(data.get("idTr"));
  document.getElementById("modalInfoTractora").scrollTo(0, 0);
  creaNotificacion(noti, "Datos de la tractora desplegados");
  modificaNotificacion(noti, "alert alert-success");
  datosC.classList.remove("d-none");
}

/**Logout */
function logout() {
  data = new FormData();
  data.append("logout", 1);
  fetch("../php/gestorcuenta.php", {
    method: "POST",
    body: data,
  }).then((_) => {
    localStorage.clear();
    location.reload();
  });
}

/*
 *Funcion para crear un elemento <p> para notificaciones en el DOM
 */
function creaNotificacion(padre, texto) {
  padre.className = "alert alert-danger";
  var noti = document.createElement("p");
  noti.innerText = texto;
  padre.appendChild(noti);

  eliminaNodos(padre);
}
function modificaNotificacion(padre, clas) {
  padre.className = clas;
}
function noNull(valor) {
  if (valor == null) {
    return "No definido";
  } else {
    return valor;
  }
}
function setLink(valor, etiqueta) {
  if (valor == null) {
    etiqueta.removeAttribute("target");
    etiqueta.removeAttribute("href");
  } else {
    etiqueta.setAttribute("href", "../php/" + valor);
    etiqueta.setAttribute("target", "_blank");
  }
}
