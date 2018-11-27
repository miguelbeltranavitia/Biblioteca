@extends('Layouts.Master') 

@section('Titulo') 
ENCUESTAS 
@endsection 

@section('Importaciones')
<script type="text/javascript" src="{{ URL::to('js/mostrarPreguntas.js') }}"></script>
<!--Script para mostrar preguntas-->
@endsection 

@section('Body')
<body onload="MostrarOtro()">
    <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
    <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
        <img src='img/wait.gif'/>
    </div>
    <div class="container-fluid">
        <div class="contenedor">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text text-white" for="inputGroupSelect01" style="background-color:#003A66">Tipo de Usuario</label>
                </div>
                <select class="custom-select" name="tipoUsuario_id" id="tipoUsuario_id" onchange='MostrarOtro();'> 
                    @foreach($tiposUsuario as $tipoUsuario)        
                        <option value="{{$tipoUsuario->ID}}"> {{$tipoUsuario->TIPO}} </option>
                    @endforeach
                </select>
            </div>

            <div id="otro">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-white" style="background-color:#003A66" id="basic-addon1">Otro</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Especifique su respuesta" aria-label="Username" aria-describedby="basic-addon1" name="descripcion" id="descripcion" value=1 maxlength="50">
                </div>
            </div>
            <br>
    
            @foreach($encuestasActivas as $encuestaActiva) 
                @if($encuestaActiva->TIPO == "salida")   
                <div class="card border-dark mb-3">
                    <div class="card-header text-white" style="background-color:#003A66">
                           <h5 style="text-align:center"> Encuesta de Salida </h5>  
                    </div>
                    <div class="card-body collapse" id="salida">
                        <form method="POST" id="encuestaSalida">
                            <input type="hidden" name="matricula" id="matricula" value={{$matricula}}>
                            <input type="hidden" name="encuestaId" id="encuestaId" value={{$encuestaActiva->ID}}>
                            <input class="oculta"name="tipoUsuario" id="tipoUsuario" required value=1>
                            <input type="hidden" name="registroBibliotecaId" id="registroBibliotecaId" value={{$registrosBiblioteca->ID}}>
                            <input type="hidden" name="tipoEncuesta" id="tipoEncuesta" value="salida">
                            
                            <div class="form-group">
                                @foreach($preguntas as $pregunta)
                                    <div id={{$pregunta->NO_PREGUNTA}} class={{$pregunta->VISIBLE}}> 
                                        @php ($cambiar=$pregunta->NO_PREGUNTA + 1)
                                        @if($pregunta->ENCUESTA_ID==$encuestaActiva->ID) 
                                            <b>{{$pregunta->PREGUNTA}}</b>
                                            <br> 
                                            @if($pregunta->TIPO == 1)
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Comentario</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Especifica tu respuesta" aria-label="Username" aria-describedby="basic-addon1" name="pregunta{{$pregunta->NO_PREGUNTA}}" id="pregunta{{$pregunta->NO_PREGUNTA}}" maxlength="300">
                                                </div>
                                                <input type="hidden" name="pregunta_id{{$pregunta->NO_PREGUNTA}}" id="pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 

                                            @elseif($pregunta->TIPO == 2)
                                                <div class="custom-control custom-radio custom-control-inline" onchange="mostrar({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}1" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="Si" required>
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" onchange="ocultar({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}2" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="No">
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}2">No</label>
                                                </div>
                                                <input type="hidden" name="pregunta_id{{$pregunta->NO_PREGUNTA}}" id="pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 

                                            @elseif($pregunta->TIPO == 3)
                                                <div class="custom-control custom-radio custom-control-inline" onchange="ocultar({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}1" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="Si" required>
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" onchange="mostrar({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}2" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="No">
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}2">No</label>
                                                </div>
                                                <input type="hidden" name="pregunta_id{{$pregunta->NO_PREGUNTA}}" id="pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 

                                            @elseif($pregunta->TIPO == 4)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}1" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="Si">
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}2" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="No">
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}2">No</label>
                                                </div>
                                                <div class="oculta">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}3" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="" checked>
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}3"></label>
                                                </div>
                                                <input type="hidden" name="pregunta_id{{$pregunta->NO_PREGUNTA}}" id="pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}>
                                            @elseif($pregunta->TIPO == 6)
                                                <div class="custom-control custom-radio custom-control-inline" onchange="ocultarSi({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}1" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="Si" required>
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline" onchange="mostrarSi({{$cambiar}});">
                                                    <input type="radio" id="{{$pregunta->NO_PREGUNTA}}2" name="pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="No">
                                                    <label class="custom-control-label" for="{{$pregunta->NO_PREGUNTA}}2">No</label>
                                                </div>
                                                <input type="hidden" name="pregunta_id{{$pregunta->NO_PREGUNTA}}" id="pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 
                                            @endif
                                        @endif    
                                    </div>
                                @endforeach 
                                <br>
                                <button type="submit" class="btn btn-success" style="float:right" name="btn-salida">Terminar</button>
                            </div>
                        </form>
                    </div>
                </div>  
                <div class="alert alert-success collapse" role="alert" id="mensaje">
                    Muchas gracias tu encuesta ha sido completada las respuestas nos ayudan a mejorar nuestros servicios. 
                </div>


                @elseif($encuestaActiva->TIPO == "satisfaccion")
                <div class="card border-dark mb-3">
                    <div class="card-header text-white" style="background-color:#003A66">
                        <h5 style="text-align:center"> Encuesta de Satisfacción </h5>  
                    </div>
                    <div class="card-body collapse" id="satisfaccion">
                        <div class="container-fluid">
                            <div class="container">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="img/sgc_log.png" alt="Responsive image" id="sgc" class="img-fluid float-sm-left" style="width: 70%;margin-top: -15px;">
                                    </div>
                                    <div class="col-8">
                                        <center>
                                            <b><h5 id="Titulo_encuesta">ENCUESTA DE SATISFACCIÓN DEL USUARIO<br> SISTEMA BIBLIOTECARIO<br>
                                            {{$encuestaActiva->NOMBRE}}</h5></b>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" id="encuestaSatisfaccion">
                            <input type="hidden" name="matricula" id="matricula" value={{$matricula}}>
                            <input type="hidden" name="encuestaId" id="encuestaId" value={{$encuestaActiva->ID}}>
                            <input class="oculta" name="tipoUsuario" id="tipoUsuario" required value=1>
                            <input type="hidden" name="registroBibliotecaId" id="registroBibliotecaId" value={{$registrosBiblioteca->ID}}>
                            <input type="hidden" name="tipoEncuesta" id="tipoEncuesta" value="satisfaccion"> 

                            @foreach($preguntas as $pregunta)
                            <div id=2{{$pregunta->NO_PREGUNTA}} class={{$pregunta->VISIBLE}}> 
                                @php ($cambiar=$pregunta->NO_PREGUNTA + 1) 
                                @if($pregunta->ENCUESTA_ID==$encuestaActiva->ID) 
                                    <b>{{$pregunta->PREGUNTA}}</b>
                                    <br> 
                                    @if($pregunta->TIPO == 1)
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Comentario</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Especifica tu respuesta" aria-label="Username" aria-describedby="basic-addon1" name="2pregunta{{$pregunta->NO_PREGUNTA}}" id="2pregunta{{$pregunta->NO_PREGUNTA}}" maxlength="300">
                                        </div>
                                        <input type="hidden" name="2pregunta_id{{$pregunta->NO_PREGUNTA}}" id="2pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 
                                    
                                    @elseif($pregunta->TIPO == 5)
                                        <div class="custom-control custom-radio custom-control-inline">
                                        <br>
                                        <br>
                                            <input type="radio" id="2{{$pregunta->NO_PREGUNTA}}1" name="2pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="MUY DE ACUERDO" required>
                                            <label class="custom-control-label" for="2{{$pregunta->NO_PREGUNTA}}1">MUY DE ACUERDO</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="2{{$pregunta->NO_PREGUNTA}}2" name="2pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="DE ACUERDO">
                                            <label class="custom-control-label" for="2{{$pregunta->NO_PREGUNTA}}2">DE ACUERDO</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="2{{$pregunta->NO_PREGUNTA}}3" name="2pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="EN DESACUERDO">
                                            <label class="custom-control-label" for="2{{$pregunta->NO_PREGUNTA}}3">EN DESACUERDO</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="2{{$pregunta->NO_PREGUNTA}}4" name="2pregunta{{$pregunta->NO_PREGUNTA}}" class="custom-control-input" value="MUY EN DESACUERDO">
                                            <label class="custom-control-label" for="2{{$pregunta->NO_PREGUNTA}}4">MUY EN DESACUERDO</label>
                                        </div>
                                        <input type="hidden" name="2pregunta_id{{$pregunta->NO_PREGUNTA}}" id="2pregunta_id{{$pregunta->NO_PREGUNTA}}" value={{$pregunta->PREGUNTA_PREGUNTAS_ID}}> 
                                
                                    @endif
                                @endif    
                            </div>
                            
                            @endforeach 
                            <br>
                            <button type="submit" class="btn btn-success" style="float:right">Terminar</button>
                        </form>
                    </div>
                </div>    
                @endif 
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm"> 
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <button class="btn btn-info btn-lg btn-block"onclick="location.href = '{{ asset('inicio') }}'">Terminar</button>
            </div>
        </div>
    </div>
    <br>
    <br>       
</body>
@endsection 

@section('ImportacionesF')
<script type="text/javascript" src="{{ URL::to('js/ajax_post_encuestas.js') }}"></script>
<!--Script para registrar respuestas-->
@endsection
