

   var matricula = $("#matricula");
   var cachar = $("#cachar");
   var procesos  = $("#procesos");
   var token = $("#token");
   var otro = $("#otro");
   var btningresar = $("#btn-ingresar");
   var descripcion = $("#descripcion");
   var _nombre  = $("#_nombre");
   var _paterno  = $("#_paterno");
   var _materno  = $("#_materno");
   var _escuela  = $("#_escuela");
   var _carrera  = $("#_carrera");
   var text  = $("#text");
   var src  = $("#src");
   var btnCorreo = $("#btn-correo");

   matricula.keyup(function(){
      delay(function(){
        getUsuario();
      }, 1500);
   });
    
    function getUsuario(){
      console.log("Entre");
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
              btningresar.prop('disabled', false); 
            }
            else if(cachar.val()==="procesos")
            {
              procesos.prop('disabled', false);
              btningresar.prop('disabled',false);
            }
            else if(cachar.val()==="primera")
            {
              procesos.prop('disabled', false);
              btningresar.prop('disabled',false);
            }
            else if(cachar.val()==="No existe")
            {
              toastr.error('Matricula invalida', 'Error', {timeOut: 5000});
            }
            else
            {
              procesos.prop('disabled', true);
              btningresar.prop('disabled',true);
             }
         
            console.log(JSON.stringify(response.respuesta));     
          },
          error: function(){
            procesos.prop('disabled', true);
            btningresar.prop('disabled',true);
            console.log('Ha ocurrido un error');
            toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
          }
       });    
    };
    function funciones ()
    {
      if($("#matricula").val() === '' || $("#descripcion").val() === ''){
        toastr.warning('Los campos', 'Complete', {timeOut: 5000});
      }else{
        var x = cachar.val();
        if(x =="procesos")
        {
          console.log('PROCESOS');
          insertar(); 
        }
        else if(x=="preguntas")
        {
          console.log('PREGUNTAS');
          $("#formulario").submit(); 
        }
        else if(x=="primera")
        {
          console.log('PRIMERA');
          $.ajax({
            url:'datosSesion',
            headers: {
              'X-CSRF-TOKEN':token.val()
            },
            dataType:'json',
            data:{"matricula":matricula.val()},
            type:'POST',
            success: function (response){
              $("#modalDatos").modal('show');
              _nombre.text(response.NOMBRE+"  ");
              _paterno.text(response.PATERNO+"  ");
              _materno.text(response.MATERNO);
              _escuela.text(response.DESC_ESCUELA);
              _carrera.text(response.DESC_CARRERA);
              text.val(response.CVE_ALUMNO);
              makeCode();
            },
            error: function(){
              console.log('Ha ocurrido un error');
            }
          });
        }
    }
  }
  
    function insertar(){
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
          btningresar.prop('disabled',true);
          procesos.prop('disabled',true);
          console.log(JSON.stringify("ee" +response));              
        }, 
        error: function(){
          procesos.prop('disabled', true);
          btningresar.show();
          btningresar.prop('disabled',true);
          toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
          console.log('Ha ocurrido un error');
        }
      });      
    }

   $('#formularioCorreo').submit(function(e){
    e.preventDefault();
    btnCorreo.prop('disabled',true);
    var formData =$(this).serializeArray();
        $.ajax({   
        url:'/enviarEmail',
        headers: {
            'X-CSRF-TOKEN':token.val()
        },
        dataType:'json',
        data: formData,
        type:'POST',          
        success: function(response)             
        {
          console.log(JSON.stringify(response));
          if(response == 1)
          {
            toastr.success('Enviado correctamente', 'Correo', {timeOut: 5000});
            insertar();
          }           
        }, 
        error: function(){
            console.log('Ha ocurrido un error');
        }
    });
  });
   
    $('select').on('change', function() {
      if(this.value!=13)
      {
        descripcion.val(this.value);
      }else
      {
        descripcion.val("");
      }
     }); 

     var qrcode = new QRCode("qrcode");
     function makeCode () {      
         var elText = document.getElementById("text");
         qrcode.makeCode(elText.value);
         var imgsrc = $("#qrcode img").attr("src");
         src.val(imgsrc);
         console.log(imgsrc);
     }
     
     $("#modalDatos").on('hidden.bs.modal', function(){
        _nombre.text("");
        _paterno.text("");
        _materno.text("");
        _escuela.text("");
        _carrera.text("");
        text.val("");
     });
     
     var delay = (function(){
       var timer = 0;
       return function(callback,ms){
         clearTimeout (timer);
         timer= setTimeout(callback,ms);
       };
     })();