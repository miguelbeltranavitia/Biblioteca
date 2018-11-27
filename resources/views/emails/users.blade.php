@component('mail::message')
# Buen día:

Esta es tu matricula y QR para acceder a la biblioteca.

<b>Matricula:</b>{{ $demo->matricula }}
<img src="{{ url($demo->imagen) }}">

 <!-- 
                                        <p> Esta es tu matricula y QR para acceder a los servicios bibliotecarios en tus próximas visitas.</p>                           
                                        <p><b>Matricula:</b>&nbsp;{{ $demo->matricula }}</p>
                                        <p><b>  </b>&nbsp;<img src="{{ $message->embed( $demo->imagen) }}"></p>                   
                                        <p>Gracias por su visita.</p>--> 
<br>
Gracias por su visita.
@endcomponent