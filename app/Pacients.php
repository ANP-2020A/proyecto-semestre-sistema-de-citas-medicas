<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacients extends Model
{
    protected $fillable = ['nombre', 'apellido', 'fecha_nac_paciente', 'cedula', 'mail_paciente', 'telefono_paciente'];
}
