<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //

    protected $fillable = [
        'comentario',
        'prospecto_id'
    ];

    public function prospecto()
    {
        return $this->belongsTo(Prospecto::class);
    }
}
