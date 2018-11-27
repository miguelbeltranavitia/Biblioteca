
var token = $("#token");

$('#nuevaEncuesta').submit(function(e){
    e.preventDefault();
    var formData =$(this).serializeArray();
      $.ajax({   
        url:'AgregarNuevaEncuesta',
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
  