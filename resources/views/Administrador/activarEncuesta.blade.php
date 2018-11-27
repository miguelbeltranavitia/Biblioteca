@extends('Layouts.MasterAdmin') 
@section('Titulo') 
ACTIVAR ENCUESTA
@endsection 

@section('Importaciones')

@endsection 

@section('Body')
  <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
    <img src='img/wait.gif'/>
  </div>
  <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
  
    <div class="container-fluid">
      <div class="container">
          <div class="row">
              <div class="col-sm"> 
                <h5>Agregar encuesta de satisfacción nueva.<h5>
                
                <form method="post" id="nuevaEncuesta">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nombre encuesta</span>
                            <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="encuestaNueva" id="encuestaNueva" required>    
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                  <h5></h5>
                    <br>                      
                  <button type="submit" class="btn btn-success">Guardar nombre</button> 
                </div>  
                </form>
            </div>        
        <table class="table table-hover" style="width:60%">
          <thead class="thead-dark">
              <tr>                                    
                  <th>Nombre</th>
                  <th>Estado</th>
              </tr>
          </thead>
          <tbody>
            @foreach($encuestas as $encuesta)
              <tr>
                <th>      
                  {{$encuesta->NOMBRE}}    
                </th>
                <th>
                @if($encuesta->ESTADO == 1)
                  <label class="switch">
                    <input  id="{{$encuesta->ID}}" name="{{$encuesta->ID}}"  onclick="activar({{$encuesta->ID}});" type="checkbox" checked>
                    <span class="slider round"></span>
                  </label> 
                @else($encuesta->ESTADO == 0)
                  <label class="switch">
                    <input  id="{{$encuesta->ID}}" name="{{$encuesta->ID}}"  onclick="activar({{$encuesta->ID}});" type="checkbox">
                    <span class="slider round"></span>
                  </label> 
                @endif
                </th>
              </tr>
            @endforeach
          </tbody>
        </table>
      <div>
    <div>
        

@section('ImportacionesF')
<script type="text/javascript" src="{{ URL::to('js/administrador/activarEncuesta.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('js/administrador/nuevaEncuesta.js') }}"></script> 
@endsection