<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Bienvenido extends Mailable
{
    use Queueable, SerializesModels;
    
    public $demo;
     /**
     * Build the message.
     *
     * @return void
     */
     public function __construct($demo)
    {
       $this->demo = $demo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ujed@durango.com','UJED')
        ->view('Email.plantilla_email');
    }
}
