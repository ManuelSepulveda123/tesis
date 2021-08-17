<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_provincia',
        'id_comuna',
        'id_tipo_usuario',
        'nom_usuario',
        'apellido_p_usuario',
        'apellido_m_usuario',
        'rut_usuario',
        'direc_usuario',
        'correo_usuario',
        'contra_usuario',
        'fecha_naci_usuario'
    ];

    protected $hidden = [
        'contra_usuario'
    ];
}
