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
        $specialties = Specialty::create($request->all());

        return response()->json($specialties, 201);
    }
    public function update(Request $request, Specialty $specialties)
    {
        $specialties->update($request->all());
        return response()->json($specialties, 200);
    }
    public function delete(Specialty $specialties)
    {
        $specialties->delete();

        return response()->json(null, 204);
    }
}
