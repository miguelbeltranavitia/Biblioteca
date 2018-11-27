
var token = $("#token");
function activar(ID) {
    if(document.getElementById(ID).checked) {
        // Hacer algo si el checkbox ha sido seleccionado
        activarEncuesta(ID,1);
    } else {
        // Hacer algo si el checkbox ha sido deseleccionado
        activarEncuesta(ID,0);
    }
}

    function activarEncuesta(id_encuesta,estado){
        $.ajax({
            url:'modificarEstadoPost',
            headers: {
              'X-CSRF-TOKEN':token.val()
            },
            dataType:'json',
            data:{"id_encuesta":id_encuesta, "estado":estado},
            type:'POST',
            success: function (response){
             
            },
            error: function(){
              console.log('Ha ocurrido un error');
              
            }
         });    
      };
    