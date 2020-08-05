<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class User extends JsonResource
{

    protected $token;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'idcard' => $this->idcard,
            'phone' => $this->phone,
            'address' => $this->address,
            'email' => $this->email,
            'status' => $this->status,
            'role' => $this->role,
            //$this->mergeWhen(Auth::user()->userable_type == 'App\Doctor', $this->userable),
            $this->merge($this->userable),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'token' => $this->when($this->token, $this->token),

        ];


    }


}

