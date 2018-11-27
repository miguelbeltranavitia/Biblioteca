function mostrar(pregunta){
    try { 
        document.getElementById(pregunta).className = "visible";
        document.getElementById('pregunta'+pregunta).required = true;
    } catch(err) {
    } 
    
    try {
    document.getElementById(pregunta+'1').checked = true;
    } catch(err) {
    } 
}

function ocultar(pregunta){
    try { 
    document.getElementById(pregunta).className = "oculta";
   
    document.getElementById('pregunta'+pregunta).required = false;
    }catch(err) {
    }
    
    try { 
    document.getElementById(pregunta+'3').checked = true;
    } catch(err) {
    } 
}  

function MostrarOtro(){
    var tipoUsuario = document.getElementById("tipoUsuario_id"); 
    var otro = document.getElementById("otro");
    $('#salida').collapse('show');
    $('#satisfaccion').collapse('show');
    if(tipoUsuario.value == 5)
    { 
        otro.style.display = "block";
        document.getElementById('descripcion').required = true;
    }   
    else 
    {
        otro.style.display = "none";
        document.getElementById('descripcion').required = false;
    }
}
function ocultarSi(pregunta){
    try { 
        var suma = parseInt(pregunta) + 1;
        document.getElementById(pregunta).className = "visible";
        document.getElementById(suma).className = "oculta";
        document.getElementById('pregunta'+suma).required = false;
    } catch(err) {
    } 
    try { 
        document.getElementById(pregunta+'1').checked = true;
        } catch(err) {
        } 
}

function mostrarSi(pregunta){

    try { 
        var suma = parseInt(pregunta) + 1;
        document.getElementById(pregunta).className = "oculta";
        document.getElementById(suma).className = "visible";
        document.getElementById('pregunta'+suma).required = true;
    } catch(err) {
    } 
    try { 
        document.getElementById(pregunta+'3').checked = true;
        } catch(err) {
        }
    } 
