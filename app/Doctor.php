<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['specialty'];
    public $timestamps = false;

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
