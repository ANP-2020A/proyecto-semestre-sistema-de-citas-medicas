<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\Appointment as AppointmentResource;
use App\User;
use App\Http\Resources\AppointmentCollection;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
   public function index() //User $user
    {
        //$this->authorize('viewAny', Appointment::class);

        $user = Auth::user();
        //return response()->json(AppointmentResource::collection($user->appointments),200);
      return new AppointmentCollection($user->appointments);
    }



    public function show(User $user, Appointment $appointments)
    {

        //$this->authorize('view', $appointments);

        //$appointments = $user->appointments()->where('id',$appointments->id)->firstOrFail();
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
            'description' => 'required|string|max:255',
            'status' => 'required',
            'time' => 'required|unique:appointments',
        ], $messages);


        $appointments = Appointment::create($request->all());
        return response()->json($appointments, 201);
    }
    public function update(Request $request, Appointment $appointments)
    {

        $this->authorize('update', $appointments);
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
       //$appointment->update($request->all());
        //return response()->json($appointment, 200);
        $appointments = new Appointment($request->all());
        return response()->json(new AppointmentResource($appointments), 200);


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
