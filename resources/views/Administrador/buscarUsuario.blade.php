@extends('Layouts.MasterAdmin') 
@section('Titulo') 
BUSCAR USUARIO
@endsection 

@section('Importaciones')

     
@endsection 

@section('Body')
<form method="post" id="formularioCorreo">
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Su Marticula y QR son:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="position-fixed" id="wait2" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
            <img src='img/wait.gif'/>
          </div>
          {{ csrf_field() }}
          <input id="src" name="imagen" type="hidden"/>  
          <div class="alert alert-success" role="alert">
              Escribe un correo <b>Gmail</b> a donde se enviaran los datos de acceso.
          </div>
          <center>
            <input class="form-control" type="email" name="email" placeholder="ejemplo@gmail.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@+gmail+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required/>
            <br>
            <span class="badge badge-secondary">
              <h5 style="padding-left:30%"><input type="text" class="form-control-plaintext text-white" aria-label="Username" aria-describedby="basic-addon1" name="text" id="text" readonly></h5>
            </span>
            <br>
            <br>
            <div id="qrcode" class="float-sm-left" style="padding-left:17%"></div>
          </center>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</form>

  <body onload="makeCode()">
    <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
      <img src='img/wait.gif'/>
    </div>
    <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
       
    <div class="container">
      <div class="row">
        <div class="col"> 
          <div class="input-group container row justify-content-md-center">
            <input type="text" class="form-control" placeholder="Buscar..." name="paterno" id="paterno" style="width:50%">
            <div class="input-group-append">
              <button class="btn btn-secondary" type="button" id="btn-buscar"> <ion-icon class="icon" name="search"></ion-icon>
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
  
    <div class="container">
        <h2>Registros</h2>
        <table class="table table-hover">
          <thead class="thead-dark">
            <tr>
                <th>Matricula</th>
                <th>Nombre(s)</th>
                <th>Paterno</th>
                <th>Materno</th>
                <th>Dato</th>
                <th>QR</th>
                <th></th>
            </tr>
          </thead>
          <tbody id="tbodyUsuario">
          </tbody>
        </table>
      </div>     
  </body>
 
@endsection

@section('ImportacionesF')
<script type="text/javascript" src="{{ URL::to('js/administrador/buscar.js') }}"></script> 
@endsection