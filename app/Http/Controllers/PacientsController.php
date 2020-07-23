<?php

namespace App\Http\Controllers;

use App\Pacients;
use Illuminate\Http\Request;

class PacientsController extends Controller
{
    public function index()
    {
        return Pacients::all();
    }
    public function show(Pacients $pacients)
    {
        return $pacients;
    }
    public function store(Request $request)
    {
        $pacients = Pacients::create($request->all());

        return response()->json($pacients, 201);
    }
    public function update(Request $request, Pacients $pacients)
    {
        $pacients->update($request->all());
        return response()->json($pacients, 200);
    }
    public function delete(Pacients $pacients)
    {
        $pacients->delete();

        return response()->json(null, 204);
    }
}
