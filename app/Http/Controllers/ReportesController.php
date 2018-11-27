<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;


class ReportesController extends Controller
{
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function enviarDatos(Request $request){
        //dd($request->all());
        $response = $this->client->request('GET', 'api/FILTROPROCESOS/', [
            'query' => $request->all()
        ]);

        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        
        }
    }



}
