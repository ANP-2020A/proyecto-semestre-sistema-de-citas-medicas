<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'birthdate', 'idcard', 'phone', 'address', 'email', 'password','specialty_id'
        , 'image'
    ];
    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_DOCTOR = 'ROLE_DOCTOR';
    const ROLE_PACIENTE = 'ROLE_PACIENTE';

    private const ROLES_HIERARCHY = [
        self::ROLE_SUPERADMIN => [self::ROLE_DOCTOR],
        self::ROLE_DOCTOR => [self::ROLE_PACIENTE],
        self::ROLE_PACIENTE => []
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function specialty() {
        return $this->belongsTo('App\Specialty');
    }

    public function isGranted($role) {
        if ($role === $this->role) {
            return true;
        }
        return self::isRoleInHierarchy($role, self::ROLES_HIERARCHY[$this->role]);
    }
    private static function isRoleInHierarchy($role, $role_hierarchy) {
        if (in_array($role, $role_hierarchy)) {
            return true;
        }
        foreach ($role_hierarchy as $role_included) {
            if(self::isRoleInHierarchy($role,self::ROLES_HIERARCHY[$role_included])) {
                return true;
            }
        }
        return false;
    }
}
