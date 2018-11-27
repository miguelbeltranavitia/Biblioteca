<!DOCTYPE html>
<html>

<head>

    <title>Instascan</title>
    <script type="text/javascript" src="{{ URL::to('js/instascan.min.js') }}"></script>
    <!--Script para lector de QR-->
    <script type="text/javascript" src="{{ URL::to('js/procesos.js') }}"></script>
    <!--Script para mostrar procesos -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--Toast para mostrar notificaciones -->
    <script type="text/javascript" src="{{ URL::to('js/toastr.js') }}"></script>
    <link type="text/css" href="css/toastr.css" rel="stylesheet" />
    <link type="text/css" href="css/principal.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body onload="MostrarOtro()">
    <audio id="audio" style="display:none" controls>
        <source type="audio/wav" src="/sound/acceso.mp3">
    </audio>
    <input type="text" id="cachar" style="display:none">
    <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
    <div id="header">
        <section id="log-ujed">
            <img src="img/ujed.png" id="log-ujed" class="img-fluid">
            <img src="img/feca.jpg" id="log-feca" class="img-fluid">
        </section>
        <section id="titulos">
            <h1 class="visible-lg" id="nombre-sistema">Sistema Bibliotecario</h1>
        </section>
    </div>
    <div class="container">
        <div class="contenedor">
         <div class="jumbotron" id="jumbcc">
                <h1 class="display-4" id="titulo1">BIENVENIDO!</h1>
                <hr class="my-4">
                <video id="preview"></video>
                <script type="text/javascript" src="{{ URL::to('js/camara.js') }}"></script>
                <!--Script para activar la camara-->
                <hr class="my-4">
                <form method="post" id="formulario">
                        {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Matricula</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="matricula" id="matricula" required>
                    </div>

                    <div class="form-group">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Procesos</label>
                            </div>
                            <select class="custom-select" name="id_proceso" id="procesos" onchange='MostrarOtro();' disabled > 
                                @foreach($procesos as $proceso)        
                                    <option value="{{$proceso->ID}}"> {{$proceso->DESCRIPCION}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="otro">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Otro</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Especifique su respuesta" aria-label="Username" aria-describedby="basic-addon1" name="descripcion">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-preguntas" style="display:none">OK</button>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" id="btn-ingresar" disabled>OK</button>
                         </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src="{{ URL::to('js/ajax_user_exist.js') }}"></script>
<!--Script de ajax para verificar si existe el usuario-->


</html>
