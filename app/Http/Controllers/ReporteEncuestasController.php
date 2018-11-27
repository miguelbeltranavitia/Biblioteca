<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ReporteEncuestasController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function enviarDatosEncuesta(Request $request){
        //dd($request->all());
        $response = $this->client->request('GET', 'api/REPORTESENCUESTAS/', [
            'query' => $request->all()
        ]);

        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }
    }
    public function enviarComentarios(Request $request){
        //dd($request->all());
        $response = $this->client->request('GET', 'api/REPORTECOMENTARIOS/', [
            'query' => $request->all()
        ]);

        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }
    }
}
