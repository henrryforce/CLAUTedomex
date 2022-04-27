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