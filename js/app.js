/**
 * evento de escucha de carga del DOM para cargar eventos cuando este totalmente cargado 
 */
document.addEventListener('DOMContentLoaded', load)
/**
 * funcion para cargar eventos en la pagina e identificar en que archivo html estamos
 */
function load () {
  let ubi = document.body.baseURI

  if (ubi.includes('/Login.html')) {
    document.getElementById('btnlogin').addEventListener('click', enviaLogin)
  }
  if (ubi.includes('/reestablecercontrasena1.html')) {
    document.getElementById('btnResetPass').addEventListener('click',resetPassword);
  }
  if (ubi.includes('/Registrate.html')) {
    document
      .getElementById('btnaceptar')
      .addEventListener('click', enviarRegistro)
  }
  if (ubi.includes('/confirmarregistro1.html')) {
    let redireccionado = localStorage.getItem('Preregistro');
    let email = localStorage.getItem('email');
    if (redireccionado === '1') {
      let divCode = document.getElementById('preRegistro');
      let h6 = document.getElementById('modificable');
      h6.innerText= "El codigo se envio al correo " + email;
      let a = document.createElement('h6');
      a.innerText="Reenviar Código";
      a.id='reenvia';
      a.className="text-dark font-weight-regular text-decoration-none text-decoration-underline";
      divCode.appendChild(a);
      document.getElementById('reenvia').addEventListener('click',reenviarCode);
      function reenviarCode(){
        let data = new FormData();
        data.append('email',localStorage.getItem('email'));
        data.append('reenvio', 0);
        fetch('../php/registro.php', {
          method: 'POST',
          body: data
        })
          .then(res => res.json())
          .then(data => {           
            var noti = document.getElementById('notificacion')
            if (data === 'enviado') {
              creaNotificacion(noti, 'Codigo Reenviado');
            } /*else {
              window.location.assign('/confirmarregistro2.html')
            }*/
          });
      }
    }
    document
      .getElementById('btnconfirmar')
      .addEventListener('click', confirmarEmail)
  }
  if (ubi.includes('/confirmarregistro2.html')) {
    setTimeout(() => {
      window.location.assign('/Login.html')
    }, 1000);
  }
  if(ubi.includes('/reestablecercontrasena2.html')){
    document.getElementById('resetPass').addEventListener('click',codeResetPass);
  }
  if(ubi.includes('/reestablecercontrasena3.html')){
    document.getElementById('btnNewPass').addEventListener('click',cambiarPass);
  }
  if(ubi.includes('/reestablecercontrasena4.html')){
    setTimeout(() => {
      window.location.assign('/Login.html')
    }, 1000);
  }
  if(ubi.includes('/PaginaprincipalDeProveedores.php')){
    document.getElementById('btnAdminPerfil').addEventListener('click',AdminPerfilProveedor);
    document.getElementById('comodity').addEventListener('change',getval);
  }
  if(ubi.includes('/contact.html')){
    document.getElementById('btnContacto').addEventListener('click',contactoform);
  }
  if(ubi.includes('/cuenta-proveedor.php')){
    document.getElementById('btnPassword').addEventListener('click',changePassPerfilProveedor);
    document.getElementById('btnDatosGenerales').addEventListener('click',updateDatosproveedor);
  }
}
/**
 *
 */
function enviaLogin (e) {
  e.preventDefault()
  let form = document.getElementById('loginform')
  let data = new FormData(form)
  let noti = document.getElementById('notificacion')
  if (data.get('email') == '' && data.get('password') == '') {
    creaNotificacion(noti, 'Debes llenar todos los campos')
  } else {
    fetch('../php/login.php', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(data => {
        if (data === 'Bad email') {
          creaNotificacion(noti, 'El correo no esta registrado')
        }
        if (data === 'Sin Verificar') {
          creaNotificacion(
            noti,
            'El correo no esta verificado seras redireccionado en breve'
          )
          localStorage.setItem('email', document.getElementById('email').value)
          localStorage.setItem('Preregistro', 1)
          setTimeout(() => {
            window.location.assign('/confirmarregistro1.html')
          }, 1500);
        }
        if (data === 'Incorrecta') {
          creaNotificacion(noti, 'Contraseña incorrecta')
        }
        if (data.toString() === '2') {
          window.location.assign('/PaginaprincipalDeProveedores.php')
        }
        if(data.toString() === '1'){
          window.location.assign('/PaginaprincipalDeTractoras.php')
        }
      })
  }
 
}
/**
 * Funcion para generar el registro
 */
function enviarRegistro (e) {
  e.preventDefault();
  let form = document.getElementById('formRegistro');
  let data = new FormData(form);
  let notifica = document.getElementById('notificaciones')

  if (data.get('password') !== data.get('password_confirm')) {
    //        notifica.innerHTML=`<p>Las contraseñas no coinciden</p>`;
    creaNotificacion(notifica, 'Las contraseñas no coinciden')
  }
  if (data.get('nom_empresa') === '') {
    creaNotificacion(notifica, 'El nombre de la empresa es obligatorio')
  }
  if (data.get('password') === '' && data.get('password_confirm') === '') {
    creaNotificacion(notifica, 'Debes ingresar una contraseña y confirmarla')
  }
  if (data.get('email') === '') {
    creaNotificacion(notifica, 'Debes ingresar un email')
  }
  if (data.get('usertype') === null) {
    creaNotificacion(notifica, 'Debes seleccionar un tipo de usuario')
  }
  if (data.get('password').length < 8) {
    creaNotificacion(notifica, 'La contraseña debe tener almenos 8 caracteres')
  }

  if (
    data.get('password') === data.get('password_confirm') &&
    data.get('nom_empresa') !== '' &&
    data.get('password') !== '' &&
    data.get('password_confirm') !== '' &&
    data.get('email') !== '' &&
    data.get('usertype') !== null &&
    data.get('password').length >= 8
  ) {
    for(var a of data.values()){
      console.log(a);
    }
    localStorage.setItem('email', data.get('email'))
    fetch('../php/registro.php', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(data => {
        if (data === 'Registrado Correctamente') {
          window.location.assign('/confirmarregistro1.html')
        }
        if(data === 'El correo ya existe'){
          creaNotificacion(notifica, data);
        }
      })
  }
}
function confirmarEmail (e) {
  e.preventDefault()
  let form = document.getElementById('formConfirmarEmail');
  let data = new FormData(form);
  let email = localStorage.getItem('email')
  data.append('email', email);
  localStorage.setItem('code', data.get('codigo'))
  fetch('../php/registro.php', {
    method: 'POST',
    body: data
  })
    .then(res => res.json())
    .then(data => {
      var noti = document.getElementById('notificacion')
      if (data === 'Codigo erroneo') {
        creaNotificacion(noti, 'Codigo Erroneo Vuelve a intentarlo');
      } else {
        localStorage.setItem('Preregistro',0);
        window.location.assign('/confirmarregistro2.html')
      }
    });
    form.reset();
}
function resetPassword(e){
  e.preventDefault();
  let form = document.getElementById('formResetPass');
  let noti = document.getElementById('notificaciones');
  let data = new FormData(form);
  data.append('restablecer',1);
  if(data.get('email')===''){
    creaNotificacion(noti,"No puedes dejar el campo Vacio");
  }else if(!data.get('email').includes('@')){
    creaNotificacion(noti,"Correo invalido @ no detectado");
  }else{
  fetch('../php/login.php', {
    method: 'POST',
    body: data
  })
    .then(res => res.json())
    .then(data => {
      if(data==='Bad email'){
        creaNotificacion(noti,"No existe el correo en la Base de Datos");
      }else if(data==='Sin Verificar'){
        creaNotificacion(noti,"Correo sin verificar sera redirigido en breve");
        localStorage.setItem('email', document.getElementById('email').value)
          localStorage.setItem('Preregistro', 1)
          setTimeout(() => {
            window.location.assign('/confirmarregistro1.html')
          }, 1500);
      }else if(data === 'OK'){
        localStorage.setItem('email', document.getElementById('email').value)
        window.location.assign("reestablecercontrasena2.html");
      }
    })
}
}
/**
 * Validando el Codigo enviado al correo cuando se olvido la contrase
 */
function codeResetPass(e){
  e.preventDefault();
  let form = document.getElementById('formResetPassC');
  let noti = document.getElementById('notificaciones');
  let data = new FormData(form);
  let email = localStorage.getItem('email')
  data.append('email', email);
  fetch('../php/registro.php', {
    method: 'POST',
    body: data
  })
    .then(res => res.json())
    .then(data => {
      if (data === 'Codigo erroneo') {
        creaNotificacion(noti, 'Codigo Erroneo Vuelve a intentarlo');
        
      } else {
        window.location.assign('/reestablecercontrasena3.html')
      }
    });
    form.reset();
}
function cambiarPass(e){
  e.preventDefault();
  let form = document.getElementById('forNewPass');
  let noti = document.getElementById('notificaciones');
  let data = new FormData(form);
  let email = localStorage.getItem('email')
  data.append('email', email);
  data.append('resetPass',1);
  if(data.get('password_c') ===''|| data.get('password')===''){
    creaNotificacion(noti,"No puedes dejar  campos en blanco");
  } else if(data.get('password_c') !== data.get('password')){
    creaNotificacion(noti,"Las contraseñas no coinciden");
  }else if(data.get('password_c').length < 8){
    creaNotificacion(noti,"La contraseña debe ser de almenos 8 cracteres");
  }else{
    fetch('../php/login.php', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(data => {
        if(data === 'OK'){
          localStorage.clear();
          window.location.assign('/reestablecercontrasena4.html');
        }
        
      })
  }
}
/**
 * funcion para administrar el perfil de proveefores
 */
function AdminPerfilProveedor(){

  window.location.assign('/cuenta-proveedor.php');

}
/**
 * Funcion para eliminar los nodos de un elemento padre
 */
function eliminaNodos (padre) {
  setTimeout(() => {
    padre.removeChild(padre.firstElementChild);
    padre.classList.remove('alert-danger');
    padre.classList.remove('alert');
  }, 3500);
 
}
/**
 * funcion vista contacto
 */
 function contactoform(e){
   e.preventDefault();
   let form = document.getElementById('formContacto');
  let noti = document.getElementById('notificaciones');
  let data = new FormData(form);
  if(data.get('name')===''){
    creaNotificacion(noti,"Debes agregar un nombre");
  }
  if(data.get('email')===''){
    creaNotificacion(noti,"Debes agregar un email");
  }
  if(data.get('phone')===''){
    creaNotificacion(noti,"Debes agregar un telefono de contacto");
  }
  if(data.get('subject')===''){
    creaNotificacion(noti,"Debes agregar un asunto");
  }
  if(data.get('message')===''){
    creaNotificacion(noti,"Debes agregar un mensaje");
  }
  if(data.get('name')!='' &&data.get('email')!=''&&data.get('phone')!=''&&data.get('subject')!=''&&data.get('message')!=''){
    fetch('../php/contact.php', {
      method: 'POST',
      body: data
    })
      .then(res => res.json())
      .then(data => {
        console.log(data);
       
      })
  }
 }
 function changePassPerfilProveedor(e){
   e.preventDefault();
   let form = document.getElementById('formPassword');
   let noti = document.getElementById('notificaciones');
   let data = new FormData(form);
   if(data.get('email')===''){
    creaNotificacion(noti,"El campo correo no puede estar vacio");
  }
  if(data.get('password')===''){
    creaNotificacion(noti,"El campo contraseña no puede estar vacio");
  }
  if(data.get('password2')===''){
    creaNotificacion(noti,"El campo de confirmacion de contraseña no puede estar vacio");
  }
  if(data.get('password') !==data.get('password2')){
    creaNotificacion(noti,"Las contraseñas no coinciden");
  }
  if(data.get('email')!=='' && data.get('password')!=='' && data.get('password2')!=='' && data.get('password') ===data.get('password2') ){
    var toast = new bootstrap.Toast(document.getElementById('liveToast'));
    toast.show();
    document.getElementById('btnToastCambiar').addEventListener('click',()=>{
      data = new FormData(document.getElementById('formPassword'));
      data.append('cambioPassword',1);
      console.log(data.get('password'));
      fetch('../php/Gestorcuenta.php', {
        method: 'POST',
        body: data
      })
        .then(res => res.json())
        .then(data => {
          console.log(data);
         
        })
      document.getElementById('formPassword').reset();
      toast.hide();
      creaNotificacion(document.getElementById('notificaciones'),"Contrasesena actualizada");
      document.getElementById('notificaciones').className="alert alert-success";
    });
  }
 }
 /*
 * Funcion de Actualizacion de Datos de Proveedor
  */
 function updateDatosproveedor(e){
  e.preventDefault();
  let form = document.getElementById('formDatosGenProveedor');
  let noti = document.getElementById('notificacionesMD');
  let data = new FormData(form);
  
  const jpg = "image/jpeg";
  const png =  "image/png";
  const pdf = "application/pdf";
  data.append('actualizarDatos',1);
  if(data.get('Logo').type != jpg && data.get('Logo').size != png){
    creaNotificacion(noti,"Solo se admiten archivos JPG o PNG");
  }else{
    if(data.get('Logo').size > 1048576){
      creaNotificacion(noti,"Logo muy pesado");
    }
  }
  if(data.get('presentacion').type != pdf){
    creaNotificacion(noti,"Solo se admiten archivos PDF");
  }else{
    if(data.get('presentacion').size > 1048576){
      creaNotificacion(noti,"Presentacion muy pesada");
    }
  }
  
  fetch('../php/Gestorcuenta.php', {
    method: 'POST',
    body: data
  })
    .then(res => res.json())
    .then(data => {
      console.table(data);
     
    })


/*  for(i of data.values()){
    console.log(i);
  }*/
 }

 /**
  * Funcion commodity get value
  */
function getval(e){
  //console.log(e.target.value); //sacas el valor con el evento change sobre el combo id combo cmbProducto
  let data = new FormData(); //creas el form data
  data.append('tipo',e.target.value); // agregas un elemento
  //console.table(typeof(data.get('tipo')));// puedes acceder a el con .get 
  /**aqui ya va el fetch y en el body le pones el data y ya se envia solito xd  */
  fetch('../php/pruebas.php',{
    method: 'POST',
    body: data
  }).then(res => res.json())
  .then(data => {
    //console.log(data);
    let combo = document.getElementById('cmbProducto');
      combo.innerHTML='';
      console.log(Array(data[0]));
      let a=(data[0].hasOwnProperty('keys'));
      
    data.forEach(element => {
     // console.log(element['idproducto']);
     // console.log(element['producto']);
     
      var opt = document.createElement('option');
      opt.value=element['id'];
      opt.innerHTML = element['producto'];
      combo.appendChild(opt);
    });
    
    /*for (let dato=0; dato <= data.length;dato++){
      console.log(data[dato]['producto'])
      var opt = document.createElement('option');
      opt.innerHTML = data[dato]['producto'];
      combo.appendChild(opt);
  }*/
   
  })
}
/*
 *Funcion para crear un elemento <p> para notificaciones en el DOM 
 */
function creaNotificacion (padre, texto) {
  padre.className="alert alert-danger";
  var noti = document.createElement('p')
  noti.innerText = texto
  padre.appendChild(noti)

  eliminaNodos(padre)
}
