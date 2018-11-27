

var token = $("#token");
var text  = $("#text");
var src  = $("#src");

    $('#formularioRegistrar').on('submit',function(e){
        e.preventDefault();
        var formData =$(this).serializeArray();
            $.ajax({   
            url:'enviarPOSTUSUARIOS',
            headers: {
                'X-CSRF-TOKEN':token.val()
            },
            dataType:'json',
            data: formData,
            type:'POST',          
            success: function(response)             
            {
            if(response ==="0")
            {
                toastr.warning(' Correo ya registrado', 'Error', {timeOut: 5000});
            }
            else
            {
                toastr.success(' Guardado correctamente', 'Usuario', {timeOut: 5000});
                $('#enviarModal').modal('show'); 
                text.val(response);
                makeCode();
                $("#formularioCorreo").submit();
            }
            
            console.log(JSON.stringify(response));              
            }, 
            error: function(){
                toastr.error('Intentalo de nuevo', 'Error', {timeOut: 5000});
                console.log('Ha ocurrido un error');
            }
        });
    });

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
            console.log(JSON.stringify(response));              
            }, 
            error: function(){
                console.log('Ha ocurrido un error');
            }
        });
    });

    $(document).ready(function () {
        $("#correo").keyup(function () {
            var value = $(this).val();
            $("#email").val(value);
        });
    });
    var qrcode = new QRCode("qrcode");
    function makeCode () {      
        var elText = document.getElementById("text");
        qrcode.makeCode(elText.value);
        var imgsrc = $("#qrcode img").attr("src");
        src.val(imgsrc);
        console.log(imgsrc);
    }
    $("#enviarModal").on('hidden.bs.modal', function(){
        console.log('Cerrando Modal');
        window.location = "inicio"; 
    });
