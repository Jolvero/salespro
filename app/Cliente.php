<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $fillable = [
        'cliente',
        'empresa',
        'rfc',
        'direccion',
        'correo',
        'observaciones',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prospecto()
    {
        return $this->belongsTo(Prospecto::class);
    }
}
