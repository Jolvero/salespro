<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CorreoProspecto extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $mensajes;
    public $usuarios;
    public $asuntos;
    public $adjuntos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mensaje, Auth $usuario, $asunto, $adjunto)
    {
        //
        $this->mensajes = $mensaje;
        $this->usuarios = $usuario::user()->email;
        $this->asuntos = $asunto;
        $this->adjuntos = $adjunto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('correos.prospecto')->from($this->usuarios)->subject($this->asuntos);
        foreach($this->adjuntos as $adjunto)
        {
            $email->attach($adjunto);
        }

    }
}
