<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class RegistrarUsuarioController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function enviarDatos(Request $request){
        //dd($request->all());
        $response = $this->client->request('POST', 'api/USUARIOEXTERNO', [
            'json' => json_encode($request->all())
        ]); 
        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }

    }

}
