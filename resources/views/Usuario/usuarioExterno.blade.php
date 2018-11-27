@extends('Layouts.Master') 
@section('Titulo') 
REGISTRAR USUARIO
@endsection 

@section('Importaciones')
<script type="text/javascript" src="{{ URL::to('js/email/qrcode.js') }}"></script>
<!--Script para generar codigo QR-->
 
     
@endsection 

@section('Body')

<body onload="makeCode()">
    <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
    <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:1;">
        <img src='img/wait.gif'/>
    </div>
    <div class="modal fade" id="enviarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Su martícula y QR son:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="formularioCorreo">
                    <div class="modal-body">
                        <input id="src" name="imagen" type="hidden"/>  
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="float-sm-left" id="qrcode"></div>
                                </div>
                                <div class="col-sm">
                                    <h2> 
                                        <span class="badge badge-secondary">
                                            <input type="text" class="form-control-plaintext text-white" aria-label="Username" aria-describedby="basic-addon1" name="text" id="text" readonly>
                                        </span>
                                    </h2>
                                </div>
                                <div class="col-3">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="container">
                        <div class="container-fluid">
                            <div class="alert alert-success" role="alert">
                                Los datos se enviaron al correo:
                                <input class="form-control-plaintext" type="email" name="email" id="email" readonly/>        
                            </div>
                        </div>  
                    </div>  
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="contenedor">
        <div class="container-fluid">
            <div class="card border-dark mb-3">
                <div class="card-header text-white" style="background-color:#003A66">
                    <h5 style="text-align:center"> Registrar </h5>  
                </div>
                <div class="card-body">
                    <form method="post" id="formularioRegistrar">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nombre (s)</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="nombre" name="nombre" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" maxlength="100" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Apellido Paterno</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="paterno" name="paterno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" maxlength="100" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Apellido Materno</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="materno" name="materno" pattern="[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{2,48}" maxlength="100">
                        </div>

                        <select class="custom-select" id="genero" name="genero" required>
                            <option value="" selected>Selecciona tu género</option>
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO">MASCULINO</option>
                        </select>
                        <br>
                        <br>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Correo Electrónico</span>
                            </div>
                            <input class="form-control" type="email" id="correo" name="correo" placeholder="Ingresa un correo Gmail" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@+gmail+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required/>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Institución de Procedencia</span>
                            </div>
                            <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="institucion" name="institucion" maxlength="100" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Carrera</span>
                            </div>
                            <input type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" id="carrera" name="carrera" maxlength="100" required>
                        </div>
                        <br>        
                        <button type="submit" class="btn btn-success" style="float:right">Registrar</button>
                    </form>
                </div>    
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                </div>
                <div class="col-sm">
                </div>
                <div class="col-sm">
                    <button class="btn btn-info btn-lg btn-block"onclick="location.href = '{{ asset('inicio') }}'">Regresar</button>
                </div>
            </div>
        </div>
    <br>
    <br>
</body>

@endsection
@section('ImportacionesF')
    <script type="text/javascript" src="{{ URL::to('js/email/ajax_registrar_usuario.js') }}"></script>
    <!--Script de ajax para crear un usuario nuevo-->
    @endsection
