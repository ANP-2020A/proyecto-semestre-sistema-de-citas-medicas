<?php
/*namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{

    /*public static function boot() {
        parent::boot();
        static::creating(function ($appointment) {
            $appointment->user_id = Auth::id();
        });
    }*/
 /*   protected $fillable = ['datetime', 'description', 'state', 'time' ];
}*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['datetime', 'description', 'status', 'time'];
}
