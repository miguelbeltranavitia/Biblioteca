<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Bienvenido as WelcomeEmail;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function enviarDatos(Request $request)
    {   
        //dd($request->all());
        $correo = ($request->input('email'));
        $matricula = ($request->input('text'));
        $imagen = ($request->input('imagen'));
        
        $objDemo = new \stdClass();
        $objDemo->matricula = $matricula;
        $objDemo->imagen = $imagen; 
 
        Mail::to($correo)->send(new WelcomeEmail($objDemo));     
      
        if($request->ajax()) {
            return "1";
        }
        
    }

}
