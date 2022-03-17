<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fechap',
        'fechad',
        'statusprestamo',
        'user_id',
        'libro_id',
    ];
}
