@extends('Layouts.MasterAdmin') 

@section('Titulo') 
REPORTE ENCUESTAS
@endsection 

@section('Importaciones') 
<script src="https://rawgit.com/MrRio/jsPDF/master/dist/jspdf.debug.js"> </script>
<script src="https://rawgit.com/simonbengtsson/jsPDF-AutoTable/master/dist/jspdf.plugin.autotable.src.js"> </script>   
<script type="text/javascript" src="{{ URL::to('js/administrador/generarPDF.js') }}"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
@endsection 

@section('Body')
    <input id="token" style="display:none" name="_token" value="{{ csrf_token() }}">
    <div class="position-fixed" id="wait" style="display:none;width:69px;height:69px;top:50%;left:45%;z-index:100;">
        <img src='img/wait.gif'/>
    </div>   
        
    <nav class="navbar navbar-expand-xl navbar-light bg-light" style="background-color:#1f636300 !important">   
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#a" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>     
        <div class="affectedDiv collapse navbar-collapse" id="a" style="position:fixed; padding-bottom:13px; z-index:100">
            
            <ul class="nav nav-tabs flex-column flex-xl-row" id="myTab">
                <li class="nav-item" style="background-color:#1f632d">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#sectionA"> <ion-icon name="clipboard"></ion-icon> Reporte Satisfacción</a>
                </li>
                <li class="nav-item"style="background-color:#1f632d">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionB">Comentarios</a>
                </li> 
                <li class="nav-item"style="background-color:#1f632d">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionB2">Específico</a>
                </li>
                <li class="nav-item" style="background-color:#257b37">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionC"> <ion-icon name="clipboard"></ion-icon> Reporte Salida</a>
                </li>
                <li class="nav-item"style="background-color:#257b37">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionD">Comentarios</a>
                </li>
                <li class="nav-item"style="background-color:#319646">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionE"> <ion-icon name="male"></ion-icon> Filtro Género</a>
                </li>
                <li class="nav-item"style="background-color:#40bb59">
                    <a class="nav-item nav-link" data-toggle="tab" href="#sectionF"> <ion-icon name="school"></ion-icon> Filtro Escuela</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane in active">
            <form id="formulario" method="post">
                <input type="text" id="tipoEncuesta1" name="tipoEncuesta" value="satisfaccion" style="display:none">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            Desde:
                            <input class="form-control" type="date" id="fecha_desde1" name="fecha_desde" min="2018-01-01">
                        </div>
                        <div class="col-sm">
                            Hasta:
                            <input class="form-control" type="date" id="fecha_hasta1" name="fecha_hasta" min="2018-01-01">               
                        </div>
                        <div class="col-sm">
                            <br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Turno</label>
                                </div>
                                <select class="custom-select" id="turno1" name="turno">
                                    <option value="1">Todo</option>
                                    <option value="2">Matutino</option>
                                    <option value="3">Vespertino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <br>
                            <button id="btn" type="submit" class="btn btn-success">Filtrar</button>
                            <button class="btn btn-primary" onclick="pdfSatisfaccion();">Descargar PDF</button>
                        </div>    
                    </div>
                </div>
            </form>
            <br>
            <div class="container"> 
                <table class="table table-sm" id="tSatisfaccion">
                    <thead class="thead-dark">
                        <tr>                                    
                            <th>Pregunta</th>
                            <th>Muy De Acuerdo</th>   
                            <th>De Acuerdo</th>
                            <th>En Desacuerdo</th>
                            <th>Muy En Desacuerdo</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyUsuario">
                    </tbody>
                </table>    
            </div>
            <br>
            <div id="graficas" class="container">
                <div class="row">
                    <div class="col-6"><canvas id="bar-chart"></canvas></div>
                    <div class="col-6"><canvas id="bar-chart2"></canvas></div>
                </div>
                <div class="row">
                    <div class="col-6"><canvas id="bar-chart3"></canvas></div>
                    <div class="col-6"><canvas id="bar-chart4"></canvas></div>
                </div>
                <div class="row">
                    <div class="col-6"><canvas id="bar-chart5"></canvas></div>
                </div>
            </div>
        </div>

        <div id="sectionB" class="tab-pane fade">
            <br>
            <div class="container">
                <h2>Comentarios</h2>
                <table class="table table-sm" id="tComentariosSatisfaccion">
                    <thead class="thead-dark">
                        <tr>
                            <th>Comentarios adicionales</th>
                            <th>Tipo de Usuario</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyTipoUs">
                    </tbody>
                </table>    
            </div>
        </div> 
        
        <div id="sectionB2" class="tab-pane fade">
            <br>
            <div class="container">
                <p>
                    <b>MDA</b> = Muy De Acuerdo  &emsp;&emsp;
                    <b>DA</b> = De Acuerdo      &emsp;&emsp;
                    <b>ED</b> = En Desacuerdo   &emsp;&emsp;  
                    <b>MED</b> = Muy En Desacuerdo  &emsp;
                    <button class="btn btn-primary" style="" onclick="descargarExcel();">Descargar Excel</button>
                </p>
                
                <br>
                <table class="table table-sm" border="1" bordercolor="white" id="tEspecifico">
                    <thead >
                        <tr>
                            <th colspan="8" style="background-color: #0d1c2b; color: #fff">Dimensión expectativas del servicio</th>
                            <th colspan="4" style="background-color: #6C3483; color: #fff">Dimensión tiempo</th>
                            <th colspan="4" style="background-color: #2874A6; color: #fff">Dimensión aspectos tangibles</th>
                            <th colspan="4" style="background-color: #138D75; color: #fff">Dimensión calidad</th>
                            <th style="background-color: #566573; color: #fff">Comentarios</th>
                        </tr>
                    </thead>
                    <tr>
                        <td colspan="4" style="background-color: #34495E; color: #fff">El servico que se me brinda se adapta a mis necesidades como usuario</td>
                        <td colspan="4" style="background-color: #5a7da0; color: #fff">El servico otorgado cumplio con mis necesidades y expectativas solicitadas</td>
                        <td colspan="4" style="background-color: #9f6eb3; color: #fff">La respuesta al servicio solicitado se obtuvo dentro del plazo establecido </td>
                        <td colspan="4" style="background-color: #6890ab; color: #fff">Los proceso para que se me brinde el servicio son eficientes</td>
                        <td colspan="4" style="background-color: #5aab9b; color: #fff">La disposicion del personal que me brinda el servicio es adecuada</td>
                    </tr>
                    <tr style="background-color: #566573; color: #fff">
                        <td>MDA</td>
                        <td>DA</td>
                        <td>ED</td>
                        <td>MED</td>
                        <td>MDA</td>
                        <td>DA</td>
                        <td>ED</td>
                        <td>MED</td>
                        <td>MDA</td>
                        <td>DA</td>
                        <td>ED</td>
                        <td>MED</td>
                        <td>MDA</td>
                        <td>DA</td>
                        <td>ED</td>
                        <td>MED</td>
                        <td>MDA</td>
                        <td>DA</td>
                        <td>ED</td>
                        <td>MED</td>
                    </tr>
                    <tbody id="tbodyEspecifico">
                    </tbody>
                </table>    
            </div>
        </div> 
        
        <div id="sectionC" class="tab-pane fade">
            <form id="formSalida" method="post">
                <input type="text" id="tipoEncuesta" name="tipoEncuesta" value="salida" style="display:none">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            Desde:
                            <input class="form-control" type="date" name="fecha_desde" min="2018-01-01">
                        </div>
                        <div class="col-sm">
                            Hasta:
                            <input class="form-control" type="date" name="fecha_hasta" min="2018-01-01">
                        </div>
                        <input style="display:none" name="turno" value=0>
                        <div class="col-sm">
                            <br>
                            <button type="submit" class="btn btn-success">Filtrar</button>                             
                            <button class="btn btn-primary" onclick="pdfSalida();">Descargar PDF</button>
                            
                        </div>
                    </div>
                </div>
            </form>
            <br>       
            <div class="container"> 
                <table class="table table-sm" id="tSalida">
                    <thead class="thead-dark">
                        <tr>                                    
                            <th>Pregunta</th>
                            <th>Si</th>
                            <th>No</th>
                        </tr>
                    </thead>
                    <tbody id="tbodySalida">
                    </tbody>
                </table>    
            </div>
        </div>    

        <div id="sectionD" class="tab-pane fade">
            <br>
            <div class="container">
                <h2>Comentarios</h2>
                <br>
                <div id="cSatisfaccion">
                    <b>¿Cuál es el titulo que buscaba?</b>
                    <div id="Salida1"></div>
                    <br>
                    <b>¿Porqué motivo el servicio no fue satisfactorio?</b>
                    <div id="Salida2"></div>
                    <br>
                    <b>¿Porqué motivo los espacios utilizados no son adecuados?</b>
                    <div id="Salida3"></div>
                    <br>
                </div>
            </div>
        </div>

        <div id="sectionE" class="tab-pane fade">
            <form id="formProcesos" method="post">  
                <input type="text" id="tipoFiltro" name="tipoFiltro" value="procesos" style="display:none">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            Desde:
                            <input class="form-control" type="date" name="fecha_desde" min="2018-01-01">
                        </div>
                        <div class="col-sm">
                            Hasta:
                            <input class="form-control" type="date" name="fecha_hasta" min="2018-01-01">
                        </div>
                        <div class="col-sm">
                            <br>
                            <button type="submit" class="btn btn-success">Filtrar</button>
                            <button class="btn btn-primary" onclick="pdfGenero();">Descargar PDF</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="container"> 
                <table class="table table-sm" id="tGenero">
                    <thead class="thead-dark">
                        <tr>                                    
                            <th>Proceso</th>
                            <th>Masculino</th>
                            <th>Femenino</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyProcesos">
                    </tbody>
                </table>    
            </div>
        </div>

        <div id="sectionF" class="tab-pane fade">
            <form id="formCarrera" method="post">  
                <input type="text" id="tipoFiltro" name="tipoFiltro" value="carrera" style="display:none">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            Desde:
                            <input class="form-control" type="date" name="fecha_desde" min="2018-01-01">
                        </div>
                        <div class="col-sm">
                            Hasta:
                            <input class="form-control" type="date" name="fecha_hasta" min="2018-01-01">                    
                        </div>
                        <div class="col-sm">
                            <br>
                            <button type="submit" class="btn btn-success">Filtrar</button>
                            <button class="btn btn-primary" onclick="pdfEscuela();">Descargar PDF</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="container"> 
                <table class="table table-sm" id="tEscuela">
                    <thead class="thead-dark">
                        <tr>                                    
                            <th>Escuela</th>
                            <th>Carrera</th>
                            <th>Cantidad</th> 
                        </tr>
                    </thead>
                    <tbody id="tbodyCarrera">
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
        

@endsection

@section('ImportacionesF')
<script type="text/javascript" src="{{ URL::to('js/ajax_reporte_encuestas.js') }}"></script> 
<script>

    function descargarExcel(){
        //Creamos un Elemento Temporal en forma de enlace
        var tmpElemento = document.createElement('a');
        // obtenemos la información desde el div que lo contiene en el html
        // Obtenemos la información de la tabla
        var data_type = 'data:application/vnd.ms-excel';
        var tabla_div = document.getElementById('tEspecifico');
        var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
        tmpElemento.href = data_type + ', ' + tabla_html;
        //Asignamos el nombre a nuestro EXCEL
        tmpElemento.download = 'Resultados_Excel.xls';
        // Simulamos el click al elemento creado para descargarlo
        tmpElemento.click();
    }

</script>
@endsection