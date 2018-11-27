var btnsalida = $("#btn-salida");
var token = $("#token");
var tipoUsuario= $("input[name=tipoUsuario]");
var descripcion = $("#descripcion");
var Usuario = $("#tipoUsuario_id")
$('select').on('change', function() {
 tipoUsuario.val(this.value);
});

$('select').on('change', function() {
  if(this.value==5)
  {
    descripcion.val("");
    tipoUsuario.val("");
    //descripcion.val(this.value);
  }else
  {
    descripcion.val(this.value);
  }
 });

$(document).ready(function () {
  $("#descripcion").keyup(function () {
      var value = $(this).val();
      tipoUsuario.val(value);
  });
});

$('#encuestaSalida').submit(function(e){
  e.preventDefault();
  var formData =$(this).serializeArray();
    $.ajax({   
      url:'enviarPOSTSALIDA',
      headers: {
        'X-CSRF-TOKEN':token.val()
      },
      dataType:'json',
      data: formData,
      type:'POST',          
      success: function(response)             
      {
      if(response==="1")
      {
        toastr.success('correctamente', 'Guardada', {timeOut: 5000});
        $('#salida').collapse('hide');
        $('#mensaje').collapse('show');
        Usuario.prop('disabled',true);
      }
      else
      {
        toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
        toastr.error(response, 'Error', {timeOut: 5000});
      }
     
      console.log(JSON.stringify(response));              
      }, 
      error: function(){
        console.log('Ha ocurrido un error');
      }
   });
});

$('#encuestaSatisfaccion').submit(function(e){
  e.preventDefault();
  var formData =$(this).serializeArray();
    $.ajax({   
      url:'enviarPOSTSALIDA',
      headers: {
        'X-CSRF-TOKEN':token.val()
      },
      dataType:'json',
      data: formData,
      type:'POST',          
      success: function(response)             
      {
      if(response==="1")
      {
        toastr.success('correctamente', 'Guardada', {timeOut: 5000});
        $('#satisfaccion').collapse('hide');
        Usuario.prop('disabled',true);
      }
      else
      {
        toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
        toastr.error(response, 'Error', {timeOut: 5000});
      }
     
      console.log(JSON.stringify(response));              
      }, 
      error: function(){
        console.log('Ha ocurrido un error');
      }
   });
});
