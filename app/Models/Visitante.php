<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $fillable = ['documento', 'nombre', 'apellido', 'telefono', 'oficina', 'tipo_documento'];
}
