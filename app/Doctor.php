<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected$fillable = ['nombre_doctor', 'apellido_doctor',
       'mail_doctor', 'ci_doctor', 'telefono_doctor'];
}
