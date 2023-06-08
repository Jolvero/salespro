<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mailing extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mensajes;
    public $adjuntos;
    public $firmas;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje, $adjunto, Auth $firma)
    {
        //
        $this->mensajes = $mensaje;
        $this->adjuntos = $adjunto;
        $this->firmas = $firma::user()->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.show-mailing')->subject('mensaje')->from($this->firmas);

    }
}
