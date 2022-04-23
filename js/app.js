/**
 * funcion de carga de efentos cuando este totalmente cargado el dom
 */
document.addEventListener("DOMContentLoaded", load);
/**
 * funcion para cargar eventos en la pagina 
 */
function load(){
    document.getElementById('btnlogin').addEventListener("click",enviaLogin);
    
}
function enviaLogin(e){
    e.preventDefault();
    let form =document.getElementById('loginform')
    let data = new FormData(form);
    
    
    fetch("../php/login.php",{
        method:'POST',
        body:data
    })
    .then(res => res.json())
    .then(data =>{
        console.log(data);
        if(data ==="Datos Recibidos"){
            console.log('Login Correcto')
        }
        if(data ==="No hay datos"){
            console.log('Login Incorrecto')
        }
        if(data ==="Datos incompletos"){
            console.log('Login Incompleto')
        }
    })
    ;
    /*
    window.location.assign("/index.html")*/
}