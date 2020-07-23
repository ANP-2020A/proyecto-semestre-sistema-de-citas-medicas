<?php

namespace App\Http\Controllers;
use App\Quotes;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index()
    {
        return Quotes::all();
    }
    public function show(Quotes $quotes)
    {
        return $quotes;
    }
    public function store(Request $request)
    {
        $quotes = Quotes::create($request->all());

        return response()->json($quotes, 201);
    }
    public function update(Request $request, Quotes $quotes)
    {
        $quotes->update($request->all());
        return response()->json($quotes, 200);
    }
    public function delete(Quotes $quotes)
    {
        $quotes->delete();

        return response()->json(null, 204);
    }
}
