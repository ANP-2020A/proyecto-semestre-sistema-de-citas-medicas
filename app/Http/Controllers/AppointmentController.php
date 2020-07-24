<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::all();
    }
    public function show(Appointment $appointments)
    {
        return $appointments;
    }
    public function store(Request $request)
    {
        $appointments = Appointment::create($request->all());

        return response()->json($appointments, 201);
    }
    public function update(Request $request, Appointment $appointments)
    {
        $appointments->update($request->all());
        return response()->json($appointments, 200);
    }
    public function delete(Appointment $appointments)
    {
        $appointments->delete();

        return response()->json(null, 204);
    }
}
