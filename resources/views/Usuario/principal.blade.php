    @extends('Layouts.Master')
    
    @section('Titulo')
    BIENVENIDO
    @endsection

    @section('Importaciones')
    <script type="text/javascript" src="{{ URL::to('js/instascan.min.js') }}"></script>
    <!--Script para lector de QR-->
    <script type="text/javascript" src="{{ URL::to('js/procesos.js') }}"></script>
    <!--Script para mostrar procesos -->
    <script type="text/javascript" src="{{ URL::to('js/email/qrcode.js') }}"></script>
    <!--Script para mostrar hacer QR -->
    @endsection

    @section('Body')
    <div class="modal fade bd-example-modal-lg" id="modalDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="position-fixed" id="wait2" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
            <img src='img/wait.gif'/>
        </div>  
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="text-align:center">VERIFICAR DATOS</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" id="formularioCorreo">
                            {{ csrf_field() }}
                        <div class="row">
                            <div class="col-4">  
                                <div id="qrcode" class="float-sm-left"></div>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control-plaintext" name="text" id="text" readonly>
                                <b>NOMBRE: </b> 
                                <label id="_nombre"></label>
                                <label id="_paterno"></label>
                                <label id="_materno"></label>
                                <br>
                                <b>ESCUELA: </b><label id="_escuela"></label>
                                <br>
                                <b>CARRERA: </b><label id="_carrera"></label>
                            </div>
                        </div>            
                    </div>     
                    <input id="src" name="imagen" type="hidden"/> 
                    <br>
                    <div class="alert alert-success" role="alert">
                        Si sus datos son correctos, escriba un correo <b>Gmail</b> al que se enviará un código QR con el que prodrá acceder a los Servicios Bibliotecarios en sus posteriores visitas. 
                    </div>
                    <input class="form-control" type="email" name="email" placeholder="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@+gmail+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required/>   
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-correo" class="btn btn-primary">Enviar</button>
                </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <body onload="MostrarOtro(),makeCode()">
        <input type="text" id="cachar" style="display:none">
        <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
        <audio id="audio" style="display:none" controls>
            <source type="audio/wav" src="/sound/acceso.mp3">
        </audio>
        <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
            <img src='img/wait.gif'/>
        </div>  
        <div class="container-fluid">
            <div class="contenedor">
            <center>
                <div class="jumbotron w-75" style="background-color:#003a66c4">
                    <div class="embed-responsive embed-responsive-4by3" id="camara">
                        <video id="preview"></video>
                    </div>    
                    <hr class="my-4">
                    <form method="post" class="form" id="formulario">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Matricula</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="matricula" id="matricula" required>
                        </div>

                        <div class="form-group">
                            <div class="text-white" style="float:left; font-size:1.2vw">
                                Elige el motivo de tu visita
                            </div>
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
                                    <input type="text" class="form-control" placeholder="Especifique su respuesta" aria-label="Username" aria-describedby="basic-addon1" id="descripcion" name="descripcion" value=1 maxlength="60" required>
                                </div>
                            </div>
                        </div>
                    </form> 
                    <button type="submit" class="btn-success  btn-lg btn-block text-white" id="btn-ingresar" onclick="funciones();" disabled>OK</button>
                    <hr class="my-4">
                    <label class="text-white" style="float:right; position:absolute; font-size:1.2vw">Si no eres alumno de la UJED, Registrate </label>
                    <br>
                    <li class="list-inline-item"style="float:right">
                        <a class="btn btn-light" onclick="location.href = '{{ asset('registrarUsuario') }}'">Registrar</a>
                    </li>  
                </div>
            </center>
            </div>
        </div>
        
        <footer class="page-footer font-small unique-color-dark pt-4" id="footer" >
            <div class="container">
            <div class="footer-copyright text-center py-3" style="color:white">
                © {{ date('Y') }} Copyright.
            </div>
        </footer>
    </body>
    @endsection

    @section('ImportacionesF')
    <script type="text/javascript" src="{{ URL::to('js/ajax_user_exist.js') }}"></script>
    <!--Script de ajax para verificar si existe el usuario-->
    <script type="text/javascript" src="{{ URL::to('js/camara.js') }}"></script>
    <!--Script para activar la camara-->
    @endsection
