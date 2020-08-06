<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\Appointment as AppointmentResource;
use App\User;
use App\Http\Resources\AppointmentCollection;
use http\Env\Response;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(User $users) //User $user
    {
        //$this->authorize('viewAny', Appointment::class);
        return response()->json(AppointmentResource::collection($users->appointments),200);
       //return Appointment::all();
    }
    public function show(Appointment $appointments)
    {

        $this->authorize('view', $appointments);

        return response()->json(new AppointmentResource($appointments),200);

        //return $appointments;
    }
    public function store(Request $request)
    {
        $messages =[
            'required' => "El campo :attribute es obligatorio",
            'datetime.required' => "La fecha es obligatoria",
            'description.required' => "La descripcion es obligatoria y no debe
            pasarse los 100 caracteres",
            'time.required' => "La hora es obligatoria",

        ];
        $this->authorize('create', Appointment::class);
        $request->validate([
            'datetime' => 'required|unique:appointments',
            'description' => 'required|string|max:100',
            'status' => 'required',
            'time' => 'required|unique:appointments',
        ], $messages);


        $appointments = Appointment::create($request->all());
        return response()->json($appointments, 201);
    }
    public function update(Request $request, Appointment $appointment)
    {

        $this->authorize('update', $appointment);
        $messages =[
            'required' => "El campo :attribute es obligatorio",
            'datetime.required' => "La fecha es obligatoria",
            'description.required' => "La descripcion es obligatoria y no debe
            pasarse los 100 caracteres",
            'time.required' => "La hora es obligatoria",

        ];

        $request->validate([
            'datetime' => 'required|unique:appointments',
            'description' => 'required|string|max:100',
            'status' => 'required',
            'time' => 'required|unique:appointments',
        ],$messages);
        $appointment->update($request->all());
        return response()->json($appointment, 200);
    }
    public function delete(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        //$appointments->delete();
        //return response()->json(null, 204);
        $appointment->status = 'Cerrado';
        //$appointments->update($appointments->all());
        $appointment->update($appointment->toArray());
        return response()->json($appointment, 200);
    }
}
