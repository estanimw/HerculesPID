<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Evento extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'title',
        'day',
        'start',
        'end',
        'color'
    ];

    public $timestamps = false;
}
