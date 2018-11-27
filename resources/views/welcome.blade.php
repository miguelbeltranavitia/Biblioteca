<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BIENVENIDO</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
        <link rel="shortcut icon" href="img/logo.png">
        <style>
        .caja{
            background: #003968;
            top: 28%;
            left: 22%;
            width: 50%;
            position: fixed;
            width: 50%;
        }
        #fondo{
        width: 100%;
        height: 75%;
        left: 0%;
        z-index: -10;
        position: absolute;
        top: 15%;
        filter: blur(4px);
        }
        #feca{
            max-width: 50%;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="container-fluid">
                <img src="img/fondo.jpg" alt="Responsive image" id="fondo" class="img-fluid">
                <div class="jumbotron caja">
                    <center>
                    <img src="img/feca.jpg" alt="Responsive image" id="feca" class="img-fluid">
                    <br>  
                    <a class="btn btn-light" onclick="location.href = '{{ asset('inicio') }}'"><ion-icon name="school"></ion-icon> Alumno</a>
                    <a class="btn btn-light" onclick="location.href = '{{ asset('buscarUsuario') }}'"><ion-icon name="reorder"></ion-icon> Reportes</a>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>
