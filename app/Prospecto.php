<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prospecto extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'nombre',
        'estado_id',
        'empresa',
        'servicio_id',
        'correo',
        'user_id',
        'cliente_uuid',
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function tarifa()
    {
        return $this->belongsTo(Tarifa::class);
    }

}
