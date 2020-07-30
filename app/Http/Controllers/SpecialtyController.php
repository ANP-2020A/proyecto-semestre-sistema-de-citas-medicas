<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
public function index()
{
    return Specialty::all();
}
    public function show(Specialty $specialties)
    {
        return $specialties;
    }
    public function store(Request $request)
    {
        $messages =[
            'required' => "El campo :attribute es obligatorio y no debe tener mas de 20 caracteres",
        ];
        $this->authorize('create', Specialty::class);
        $request->validate([
            'name' => 'required|unique:specialties|string|max:20',

        ], $messages);

        $specialties = Specialty::create($request->all());
        return response()->json($specialties, 201);
    }
    public function update(Request $request, Specialty $specialties)
    {
        $messages =[
            'required' => "El campo :attribute es obligatorio y no debe tener mas de 20 caracteres",
        ];
        $this->authorize('update', $specialties);
        $request->validate([

            'name' => 'required|string|unique:specialties|max:20',
        ], $messages);

        $specialties->update($request->all());
        return response()->json($specialties, 200);
    }
    public function delete(Specialty $specialties)
    {
        $this->authorize('update', $specialties);
        $specialties->delete();

        return response()->json(null, 204);
    }
}
