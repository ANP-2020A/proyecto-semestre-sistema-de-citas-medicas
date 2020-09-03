<?php
/*namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



    /*
    }*/
 /*   protected $fillable = ['datetime', 'description', 'state', 'time' ];
}*/
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{

    protected $fillable = ['datetime', 'description', 'status', 'time'];

    public static function boot(){
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->pacient_id = Auth::id();
            $appointment->doctor_id = Auth::id();
        });
    }

    public function pacients(){
        return $this->belongsTo('App\User', 'pacient_id');
    }

    public function doctors(){
        return $this->belongsTo('App\User', 'doctor_id');
    }
}
