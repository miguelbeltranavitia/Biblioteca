   var paterno = $("#paterno");
   var token = $("#token");
   var btnBuscar = $("#btn-buscar");
   btnBuscar.click(getTabla);
    
    function getTabla(){
       $.ajax({
          url:'BuscarUsuarios',
          headers: {
            'X-CSRF-TOKEN':token.val()
          },
          dataType:'json',
          data:{"paterno":paterno.val()},
          type:'POST',
          success: function (response){
            var valor = ''
            $.each(response, function(index, value){
              if(value.MATRICULA===undefined)
              {
                console.log('Error');
              }
              else
              {
                valor += "<tr>"+
                "<td>" + value.MATRICULA + "</td>"+
                "<td>" + value.NOMBRE + "</td>"+
                "<td>" + value.PATERNO + "</td>"+ 
                "<td>" + value.MATERNO + "</td>"+
                "<td>" + value.DATO + "</td>"+
                "<td><button id='boton' type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModal' onclick='mandarId(\""+value.MATRICULA+"\")'> VER QR</td>"+
                "<tr>";
              }   
            })
            $("#tbodyUsuario").html(valor);
          },
          error: function(){
            console.log('Ha ocurrido un error');
          }
       });    
    };


    $('#formularioCorreo').on('submit',function(e){
      e.preventDefault();
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
            if(response == 1)
            {
              toastr.success('Enviado correctamente', 'Correo', {timeOut: 5000});
            
            }                      
          }, 
          error: function(){
              console.log('Ha ocurrido un error');
          }
      });
  });
    var text  = $("#text");
    var src  = $("#src");

    function mandarId(matricula){
    text.val(matricula);
    makeCode();


    }

    var qrcode = new QRCode("qrcode");
    function makeCode () {      
        var elText = document.getElementById("text");
        qrcode.makeCode(elText.value);
        var imgsrc = $("#qrcode img").attr("src");
        src.val(imgsrc);
        console.log(imgsrc);
    }

$(document).ready(function(){
    $(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
});