<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    //

    protected $fillable = [
        'nombre',
        'plantilla',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
