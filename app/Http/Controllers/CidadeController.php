<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidade;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Cidade::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validade([
            'cid_nome' => 'required|string|max:255',
            'cid_estado' => 'required|string|max:2'
        ]);

        $cidade = Cidade::create($request->all());
        return response()->json($cidade, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cidade = Cidade::findOrFail($id);
        return response()->json($cidade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validade([
            'cid_nome' => 'sometimes|string|max:255',
            'cid_estado' => 'sometimes|string|max:2'
        ]);

        $cidade = Cidade::findOrFail($id);
        $cidade->update($request->all());
        return response()->json($cidade);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cidade = Cidade::findOrFail($id);
        $cidade->delete();

        return response()->json(null, 204);
    }
}
