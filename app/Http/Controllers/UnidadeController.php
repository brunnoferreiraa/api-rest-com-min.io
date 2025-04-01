<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    public function index()
    {
        return response()->json(Unidade::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unid_nome' => 'required|string|max:255',
            'unid_sigla' => 'required|string|max:10'
        ]);

        $unidade = Unidade::create($request->all());

        return response()->json($unidade, 201);
    }

    public function show($id)
    {
        $unidade = Unidade::findOrFail($id);
        return response()->json($unidade);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unid_nome' => 'nullable|string|max:255',
            'unid_sigla' => 'nullable|string|max:10'
        ]);

        $unidade = Unidade::findOrFail($id);
        $unidade->update($request->all());

        return response()->json($unidade);
    }

    public function destroy($id)
    {
        $unidade = Unidade::findOrFail($id);
        $unidade->delete();

        return response()->json(null, 204);
    }
}

