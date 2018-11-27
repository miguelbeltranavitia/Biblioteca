<?php

Route::get('/inicio', 'EntradaController@procesos');
Route::post('/inicio', 'EntradaController@enviarDatos');

Route::post('enviarGET','EntradaController@existe');

Route::post('enviarPOST','EntradaController@registrarEntrada');

Route::post('enviarPOSTSALIDA','SalidaController@registrarEncuesta');

Route::get('registrarUsuario', function(){
    return view('Usuario.usuarioExterno');
});
Route::post('/enviarPOSTUSUARIOS','RegistrarUsuarioController@enviarDatos');
Route::post('/enviarEmail','EmailController@enviarDatos');

Route::get('buscarUsuario',function(){
    return view('Administrador.buscarUsuario');
});
Route::get('reportes',function(){
    return view('Administrador.reporteEncuestas');
});
Route::get('/encuestas','EncuestasController@encuestas');

Route::post('/ObtenerReporte','ReporteEncuestasController@enviarDatosEncuesta');
Route::post('/ObtenerComentarios','ReporteEncuestasController@enviarComentarios');

Route::post('/ObtenerFiltro','ReportesController@enviarDatos');


Route::post('/BuscarUsuarios','BuscarUsuarioController@enviarDatos');

Route::post('/datosSesion','DatosSesionController@enviarDatos');

Route::post('/modificarEstadoPost','EncuestasController@modificarEstadoEncuesta');

Route::post('/AgregarNuevaEncuesta','EncuestasController@nuevaEncuesta');

Route::get('/', function(){
    return view('Welcome');
});