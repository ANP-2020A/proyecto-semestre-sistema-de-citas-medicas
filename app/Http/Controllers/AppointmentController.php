<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\Appointment as AppointmentResource;
use App\Http\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index() //User $user
    {
        //$this->authorize('viewAny', Appointment::class);
        //return response()->json(AppointmentResource::collection($user->appointments),200);
       return Appointment::all();
    }
    public function show(Appointment $appointment)
    {
        //return response()->json(new AppointmentResource($appointment),200);
        //$this->authorize('view', $appointments);
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
    public function update(Request $request, Appointment $appointments)
    {
        $messages =[
            'required' => "El campo :attribute es obligatorio",
            'datetime.required' => "La fecha es obligatoria",
            'description.required' => "La descripcion es obligatoria y no debe
            pasarse los 100 caracteres",
            'time.required' => "La hora es obligatoria",

        ];
        $this->authorize('update', $appointments);
        $request->validate([
            'datetime' => 'required|unique:appointments',
            'description' => 'required|string|max:100',
            'status' => 'required',
            'time' => 'required|unique:appointments',
        ],$messages);
        $appointments->update($request->all());
        return response()->json($appointments, 200);
    }
    public function delete(Appointment $appointments)
    {
        $this->authorize('delete', $appointments);

        //$appointments->delete();
        //return response()->json(null, 204);
        $appointments->status = 'Cerrado';
        //$appointments->update($appointments->all());
        $appointments->update($appointments->toArray());
        return response()->json($appointments, 200);
    }
}
