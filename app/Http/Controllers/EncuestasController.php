<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class EncuestasController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function encuestas(){
        $response = $this->client->request('GET', 'api/ENCUESTAS/');
        $encuestas = json_decode ($response->getBody()->getContents());
        return view('administrador.activarEncuesta', compact('encuestas'));
          //dd($procesos);  
    }

    public function modificarEstadoEncuesta(Request $request){
        $id_encuesta = ($request->input('id_encuesta'));
        $estado = ($request->input('estado'));
        $response = $this->client->request('PUT', 'api/ENCUESTAS', [
            'query' => ['id_encuesta'=>$id_encuesta, 'estado'=>$estado]
        ]); 
    }
    public function nuevaEncuesta(Request $request){
        //dd($request->all());
        $response = $this->client->request('POST', 'api/NUEVAENCUESTA/', [
            'json' => json_encode($request->all())
        ]); 
        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }

    }

}
