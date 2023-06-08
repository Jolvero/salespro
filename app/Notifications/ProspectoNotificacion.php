<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;

class ProspectoNotificacion extends Notification implements ShouldQueue
{
    use Queueable;
    public $id_prospectos;
    public $nombres;
    public $empresas;
    public $correos;
    public $cotizaciones;
    public $observaciones;
    public $estados;
    public $users;
    public $redirecciones;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id_prospecto, $nombre, $empresa, $correo, $cotizacion, $observacion, $estado, $user, $redireccion)
    {
        //
        $this->id_prospectos = $id_prospecto;
        $this->nombres = $nombre;
        $this->empresas = $empresa;
        $this->correos = $correo;
        $this->cotizaciones = $cotizacion;
        $this->observaciones = $observacion;
        $this->estados = $estado;
        $this->users = $user;
        $this->redirecciones = $redireccion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http:/salespro.mrollogistics.com/prospecto/' . $this->id_prospectos . '/show';
        return (new MailMessage)
            ->line('Actualización prospectos')
            ->line('Prospecto: ' . $this->empresas)
            ->action('Ver Prospecto', $url)
            ->line('Gracias por usar SalesPro');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'id_prospecto' => $this->id_prospectos,
            'nombre' => $this->nombres,
            'empresa' => $this->empresas,
            'correo' => $this->correos,
            'cotizacion' => $this->cotizaciones,
            'observacion' => $this->observaciones,
            'estado' => $this->estados,
            'user' => $this->users,
            'redireccion' => $this->redirecciones
        ];
    }

    public function toBrodcast($notifiable)
    {
        return new BroadcastMessage([
            'id_prospecto' => $this->id_prospectos,
            'nombre' => $this->nombres,
            'empresa' => $this->empresas,
            'correo' => $this->correos,
            'cotizacion' => $this->cotizaciones,
            'observacion' => $this->observaciones,
            'estado' => $this->estados,
            'user' => $this->users,
            'redireccion' => $this->redirecciones
        ]);
    }

    public function viaQueues()
    {
        return [
            'database' => 'default'
        ];
    }
}
