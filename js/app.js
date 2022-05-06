/**
 * funcion de carga de efentos cuando este totalmente cargado el dom
 */
document.addEventListener("DOMContentLoaded", load);
/**
 * funcion para cargar eventos en la pagina e identificar en que archivo html estamos
 */
function load(){
    let ubi = document.body.baseURI;
    
    if(ubi.includes("/Login.php")){
        console.log(ubi)
        document.getElementById('btnlogin').addEventListener("click",enviaLogin);
    }
    if(ubi.includes("/reestablecercontrasena1.html")){
        console.log(ubi)
    }
    if(ubi.includes("/Registrate.html")){
       document.getElementById('btnaceptar').addEventListener("click",enviarRegistro)
    }
    if(ubi.includes("/confirmarregistro1.html")){
        document.getElementById('btnconfirmar').addEventListener("click",confirmarEmail)
    }
    
}
/**
 * 
 */
function enviaLogin(e){
    e.preventDefault();
    let form =document.getElementById('loginform')
    let data = new FormData(form);
    
    /**
     * consulta al archivo PHP de login
     */
    fetch("../php/login.php",{
        method:'POST',
        body:data
    })
    .then(res => res.json())
    .then(data =>{
        console.table(data);
        /*
        if(data ==="Datos Recibidos"){
            console.log('Login Correcto')
        }
        if(data ==="No hay datos"){
            console.log('Login Incorrecto')
        }
        if(data ==="Datos incompletos"){
            console.log('Login Incompleto')
        }*/
        
    })
    ;
    /*
    window.location.assign("/index.html")*/
}
/**
 * Funcion para generar el registro
 */
function enviarRegistro(e){
    e.preventDefault();
    let form =document.getElementById('formRegistro');
    let data = new FormData(form);
    let notifica= document.getElementById('notificaciones')
    
    if(data.get('password')!== data.get('password_confirm')){
//        notifica.innerHTML=`<p>Las contraseñas no coinciden</p>`;
        creaNotificacion(notifica,"Las contraseñas no coinciden");
    }
     if(data.get('nom_empresa') ===''){
        creaNotificacion(notifica,"El nombre de la empresa es obligatorio");
    }
     if(data.get('password')==='' && data.get('password_confirm') === ''){
        creaNotificacion(notifica,"Debes ingresar una contraseña y confirmarla");
    }
     if(data.get('email')===''){
        creaNotificacion(notifica,"Debes ingresar un email");
    }
     if(data.get('usertype')=== null){
        creaNotificacion(notifica,"Debes seleccionar un tipo de usuario");
    }
    if(data.get('password').length < 8){
        creaNotificacion(notifica,"La contraseña debe tener almenos 8 caracteres");
    }
    
    if(data.get('password')=== data.get('password_confirm') && data.get('nom_empresa') !=='' && data.get('password')!=='' && data.get('password_confirm') !== '' && data.get('email')!==''&& data.get('usertype')!== null && data.get('password').length >= 8){
        localStorage.setItem("email",data.get('email'));
        fetch("../php/registro.php",{
            method:'POST',
            body:data
        })
        .then(res => res.json())
        .then(data =>{
            if(data ==="Registrado Correctamente"){
                window.location.assign("http://localhost:3000/confirmarregistro1.html");
            }
            
            /*
            
            if(data ==="No hay datos"){
                console.log('No se enviaron los datos')
            }
            if(data ==="Datos incompletos"){
                console.log('Login Incompleto')
            }*/
            
        })
        ;
    }
    
}
function confirmarEmail(e){
    e.preventDefault();
    let form =document.getElementById('formConfirmarEmail');
    let data = new FormData(form);
    let email = localStorage.getItem('email');
    data.append('email',email);
    localStorage.setItem("code",data.get('codigo'));
    fetch("../php/verificarcorreo.php",{
        method:'POST',
        body:data
    })
    .then(res => res.json())
    .then(data =>{
        let notifica= document.getElementById('notificacion');
        let code = localStorage.getItem('code');
        if(data[0]['mail_code'] !== code){
            creaNotificacion(notifica,"Codigo incorrecto intenta lo de nuevo")
        }else{
            window.location.assign("http://localhost:3000/confirmarregistro2.html")
        }
        
        
        /*
        
        if(data ==="No hay datos"){
            console.log('No se enviaron los datos')
        }
        if(data ==="Datos incompletos"){
            console.log('Login Incompleto')
        }*/
        
    })
    ;
    
}
function eliminaNodos(padre){
    setTimeout(()=>{
            padre.removeChild(padre.firstElementChild)
    },3500);
    
}
function creaNotificacion(padre,texto){
    var noti = document.createElement("p");
    noti.innerHTML=texto;
    padre.appendChild(noti);
    
    eliminaNodos(padre);
}