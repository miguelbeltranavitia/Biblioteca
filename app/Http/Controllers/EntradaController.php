<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    public function sesion(Request $matricula){

        $respuesta = ($matricula->input('matricula'));  

        $response = $this->client->request('GET', 'api/EXIST/');
            
        
        $posts = json_decode ($response->getBody()->getContents());
        dd($posts);
        //return view('posts.index', compact('posts'));
            
    }
    public function procesos(){
        $response = $this->client->request('GET', 'api/PROCESOS/');
        $procesos = json_decode ($response->getBody()->getContents());
        return view('usuario.principal', compact('procesos'));
          //dd($procesos);  
    }

    public function enviarDatos(Request $request){
        //dd($request->all());
        $matricula = ($request->input('matricula'));
      
        $response1 = $this->client->request('GET', 'api/EXISTENCUESTAACTIVA', [
            'query' => ['matricula'=>$matricula]
        ]); 
        
        $existeEncActiva = $response1->getBody()->getContents();
        if($existeEncActiva == 0){
            $responseSalida = $this->client->request('PUT', 'api/SALIDA', [
                'query' => ['matricula'=>$matricula]
            ]); 
            return redirect()->action('EntradaController@procesos');
        }elseif($existeEncActiva == 1){
            $response2 = $this->client->request('GET', 'api/PREGUNTAS');
            $preguntas = json_decode($response2->getBody()->getContents());
            $response3 = $this->client->request('GET', 'api/ENCUESTASACTIVAS');
            $encuestasActivas = json_decode($response3->getBody()->getContents());
            $response4 = $this->client->request('GET', 'api/TIPOSUSUARIO');
            $tiposUsuario = json_decode($response4->getBody()->getContents());
            $response5 = $this->client->request('GET', 'api/ENTRADA', [
                'query' => ['matricula'=>$matricula]
            ]);
            $registrosBiblioteca = json_decode($response5->getBody()->getContents());
            $responseSalida = $this->client->request('PUT', 'api/SALIDA', [
                'query' => ['matricula'=>$matricula]
            ]);    
        }
      //return redirect('/encuestas');
       return view('usuario.preguntas',compact('matricula','preguntas','encuestasActivas','tiposUsuario', 'registrosBiblioteca'));
    }


      public function existe(Request $request)
    {
        $response = $this->client->request('GET', 'api/EXIST/', [
            'query' => $request->all()
        ]);

        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }
    }
    public function registrarEntrada(Request $request){
      
        $response = $this->client->request('POST', 'api/ENTRADA/', [
            'json' => json_encode($request->all())
        ]); 
        $body = $response->getBody();
        if($request->ajax()) {
            return $body;
        }

    }

}
