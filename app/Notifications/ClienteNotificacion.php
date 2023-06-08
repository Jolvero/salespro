<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ClienteNotificacion extends Notification implements ShouldQueue
{
    use Queueable;

    public $ids;
    public $nombres;
    public $empresas;
    public $correos;
    public $tarifas;
    public $observaciones;
    public $users;
    public $redirecciones;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id, $nombre, $empresa, $correo, $tarifa, $observacion, $user, $redireccion)
    {
        //
        $this->ids = $id;
        $this->nombres = $nombre;
        $this->empresas = $empresa;
        $this->correos = $correo;
        $this->tarifas = $tarifa;
        $this->observaciones = $observacion;
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
        $url = url('http:/salespro.mrollogistics.com/clientes/'. $this->ids. '/show');
        return (new MailMessage)
                    ->line('Nuevo Cliente.'. $this->empresas)
                    ->action('Cliente', $url)
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
            'id' => $this->ids,
            'nombre' => $this->nombres,
            'empresa' => $this->empresas,
            'correos' => $this->correos,
            'observaciones' => $this->observaciones,
            'user' => $this->users,
            'redireccion' => $this->redirecciones
        ];
    }

    public function toBrodcast($notifiable)
    {
        return new BroadcastMessage([
            //
            'id' => $this->ids,
            'nombre' => $this->nombres,
            'empresa' => $this->empresas,
            'correos' => $this->correos,
            'observaciones' => $this->observaciones,
            'user' => $this->users,
            'redireccion' => $this->redirecciones
        ]);
    }

    public function toDatabase($notifiable)
    {
        return [
            //
            'id' => $this->ids,
            'nombre' => $this->nombres,
            'empresa' => $this->empresas,
            'correos' => $this->correos,
            'observaciones' => $this->observaciones,
            'user' => $this->users,
            'redireccion' => $this->redirecciones
        ];
    }

    public function viaQueues()
    {
        return [
            'database' => 'default'
        ];
    }
}
