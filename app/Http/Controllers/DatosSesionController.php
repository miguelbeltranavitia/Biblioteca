<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DatosSesionController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function enviarDatos(Request $request){
        //dd($request->all());
        $response = $this->client->request('GET', 'api/DATOSSESION/', [
            'query' => $request->all()
        ]);

        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }
    }
}
