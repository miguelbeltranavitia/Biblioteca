    @extends('Layouts.Master')
    
    @section('Titulo')
    BIENVENDIO
    @endsection
    @section('Importaciones')
    <script type="text/javascript" src="{{ URL::to('js/instascan.min.js') }}"></script>
    <!--Script para lector de QR-->
    <script type="text/javascript" src="{{ URL::to('js/procesos.js') }}"></script>
    <!--Script para mostrar procesos -->
    @endsection

    @section('Body')
    <body onload="MostrarOtro()">
        <audio id="audio" style="display:none" controls>
            <source type="audio/wav" src="/sound/acceso.mp3">
        </audio>
        <div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:50%;left:45%;z-index:1;">
            <img src='img/wait.gif' width="64" height="64" />
      </div>
        <input type="text" id="cachar" style="display:none">
        <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
         
        <div class="container-fluid">
            <div class="contenedor">
            <div class="jumbotron" id="jumbcc" style="background-color:#003a66c4">
                    <h1 class="" id="titulo1">BIENVENIDO!</h1>
                    <hr class="my-4">
                    <center>
                    <div class="embed-responsive embed-responsive-4by3" id="camara">
                            <video id="preview"></video>
                        </div>
                     </cener>   
                    <script type="text/javascript" src="{{ URL::to('js/camara.js') }}"></script>
                    <!--Script para activar la camara-->
                    <hr class="my-4">
                    <form method="post" id="formulario">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Matricula</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="matricula" id="matricula" required>
                        </div>

                        <div class="form-group">
                        <div class="text-white" style="float:left">Elige el motivo de tu visita</div>
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
                                    <input type="text" class="form-control" placeholder="Especifique su respuesta" aria-label="Username" aria-describedby="basic-addon1" id="descripcion" name="descripcion" value=1 required>
                                </div>
                            </div>
                            <button type="submit" class="btn-success  btn-lg btn-block text-white" id="btn-ingresar"  disabled>OK</button>
                            </div>
                    </form>
                <form method="post">
                    {{ csrf_field() }}
                    <input class="form-control-plaintext" type="hidden" name="_matricula" id="_matricula">
                    <button type="submit" class="btn-success btn-lg btn-block text-white" id="btn-preguntas" style="display:none;  ">OK</button>
                            
                </form>
                </div>
            </div>
        </div>
        
        <footer class="page-footer font-small unique-color-dark pt-4" id="footer" >
        <div class="container">        
        <ul class="list-unstyled list-inline text-center py-2">
            <li class="list-inline-item">
            <h5 class="mb-1" style="color:white">Registrate para obtener una matricula</h5>
            </li>
            <br>
            <hr class="my-4">
            <li class="list-inline-item">
            <a class="btn btn-light" onclick="location.href = '{{ asset('registrarUsuario') }}'">Entrar</a>
            </li>
        </ul>
        </div>
        <div class="footer-copyright text-center py-3" style="color:white">© 2018 Copyright.       
        </div>

        </footer>
        

    </body>
    @endsection
    @section('ImportacionesF')
    <script type="text/javascript" src="{{ URL::to('js/ajax_user_exist.js') }}"></script>
    <!--Script de ajax para verificar si existe el usuario-->
    @endsection
