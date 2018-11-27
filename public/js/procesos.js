
function MostrarOtro(){
    var procesos = document.getElementById("procesos"); 
    var otro = document.getElementById("otro");
     
    if(procesos.value == 13)
    { 
        otro.style.display = "block";
    }   
    else 
    {
        otro.style.display = "none";
    }
}