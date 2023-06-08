<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationRecordatorios extends Notification
{
    use Queueable;
    public $fechas;
    public $id_recordatorios;
    public $usuarios;
    public $asuntos;
    public $id_usuarios;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($fecha, $id_recordatorio, $usuario, $asunto, $idUsuario)
    {
        //
        $this->fechas = $fecha;
        $this->id_recordatorios = $id_recordatorio;
        $this->usuarios = $usuario;
        $this->asuntos = $asunto;
        $this->id_usuarios = $idUsuario;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/recordatorio/'. $this->id_recordatorios);
        return (new MailMessage)
                    ->line('Recordatorio programado')
                    ->line('Recordatorio: '. $this->asuntos)
                    ->action('Ver Recordatorio', $url)
                    ->line('Gracias por utilizar SalesPro');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

     // almacena las notificaciones en la base de datos
     public function toDatabase($notifiable)
     {
        return [
            'fecha' => $this->fechas,
            'id_recordatorio' => $this->id_recordatorios,
            'usuario' => $this->usuarios,
            'asunto' => $this->asuntos,
            'id_usuario' => $this->id_usuarios
        ];
     }

     public function viaQueues()
     {
        return [
            'database' => 'recordatorios'
        ];
     }
}
