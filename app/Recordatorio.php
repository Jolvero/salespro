<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Recordatorio extends Model
{
    use Notifiable;
    //

    protected $fillable = [
        'asunto',
        'fecha',
        'fecha_recordatorio',
        'prospecto_id',
        'user_id',
    ];

    public function Prospecto()
    {
        return $this->belongsTo(Prospecto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
