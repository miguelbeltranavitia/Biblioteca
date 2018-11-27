

   var matricula = $("#matricula");
   var cachar = $("#cachar");
   var procesos  = $("#procesos");
   var token = $("#token");
   var otro = $("#otro");
   var btningresar = $("#btn-ingresar");
   var btnpreguntas = $("#btn-preguntas");
   var descripcion = $("#descripcion");
   matricula.on("keyup", getUsuario);
    
    function getUsuario(){
       $.ajax({
          url:'enviarGET',
          headers: {
            'X-CSRF-TOKEN':token.val()
          },
          dataType:'json',
          data:{"id":matricula.val()},
          type:'POST',
          success: function (response){
            //alert(response);
            cachar.val(response.respuesta);
           
            if(cachar.val()==="preguntas")
            {
            procesos.prop('disabled', true);
            btningresar.hide();
            btnpreguntas.show();
            }else if(cachar.val()==="procesos")
            {
            procesos.prop('disabled', false);
            btnpreguntas.hide();
            btningresar.show();
            btningresar.prop('disabled',false);
           
            }else{
              procesos.prop('disabled', true);
              btnpreguntas.hide();
              btningresar.show();
              btningresar.prop('disabled',true);
              
             }
           /* toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 2000});*/
            console.log(JSON.stringify(response.respuesta));     
          },
          error: function(){
            procesos.prop('disabled', true);
            btnpreguntas.hide();
            btningresar.show();
            btningresar.prop('disabled',true);
            console.log('Ha ocurrido un error');
            toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
          }
       });    
    };
    
    $('#formulario').submit(function(e){
      e.preventDefault();
      var formData =$("#formulario").serializeArray();
        $.ajax({   
          url:'enviarPOST',
          headers: {
            'X-CSRF-TOKEN':token.val()
          },
          dataType:'json',
          data: formData,
          type:'POST',          
          success: function(response)             
          {
          if(response==="1"){
            toastr.success('Bienvenido', 'Acceso Correcto', {timeOut: 5000});
            
          }
          else
          {
            toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
          }
          $("#formulario")[0].reset();
            matricula.prop('readonly', false);
            otro.hide();
            btnpreguntas.hide();
            btningresar.prop('disabled',true);
            procesos.prop('disabled',true);
            console.log(JSON.stringify(response));              
          }, 
          error: function(){
            procesos.prop('disabled', true);
            btnpreguntas.hide();
            btningresar.show();
            btningresar.prop('disabled',true);
            toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
            console.log('Ha ocurrido un error');
          }
       });
    });
  
    $('select').on('change', function() {
      if(this.value!=12)
      {
        descripcion.val(this.value);
      }else
      {
        descripcion.val("");
      }
     });

     $(document).ready(function () {
      $("#matricula").keyup(function () {
          var value = $(this).val();
          $("#_matricula").val(value);
          if($("#_matricula").val()===""){
            btnpreguntas.hide(); 
            btningresar.prop('disabled',true);
             
          }
      });
    });
     