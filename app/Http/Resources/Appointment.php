<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Appointment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=> $this->id,
            'datetime' => $this->datetime,
            'description' => $this->description,
            'status' => $this->status,
            'time' => $this->time,
            'user' => "/api/users/" . $this->pacient_id,
            'doctor_id' => "/api/users/" . $this->doctor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
