<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Policies\AppointmentPolicy;
//use App\Http\Resources\Appointmet as AppointmentReource;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Appointment $appointment)
    {
        //Descomentar cuando ya este la relacion USER-APPOINTMENT
        //  $appointment = $user->appointment;
        //return response()->json(AppointmentResource::collection($appointment),200);

        return Appointment::all();
    }

    public function show(Appointment $appointments)
    {
       // $this->authorize('view', $appointments);
        return $appointments;
    }

    public function store(Request $request)
    {
        $appointments = Appointment::create($request->all());

        return response()->json($appointments, 201);
    }

    public function update(Request $request, Appointment $appointments)
    {
        //$this->authorize('update', $appointments);
        $appointments->update($request->all());
        return response()->json($appointments, 200);
    }

    public function delete(Appointment $appointments)
    {
        $appointments->delete();

        return response()->json(null, 204);
    }
}
