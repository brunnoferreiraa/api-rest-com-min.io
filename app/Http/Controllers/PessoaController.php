<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        return response()->json(Pessoa::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pes_nome' => 'required|string|max:255',
            'pes_data_nascimento' => 'required|date',
            'pes_sexo' => 'nullable|string|max:1',
        ]);

        $pessoa = Pessoa::create($request->all());

        return response()->json($pessoa, 201);
    }

    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return response()->json($pessoa);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pes_nome' => 'nullable|string|max:255',
            'pes_data_nascimento' => 'nullable|date',
            'pes_sexo' => 'nullable|string|max:1',
        ]);

        $pessoa = Pessoa::findOrFail($id);
        $pessoa->update($request->all());

        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $pessoa->delete();

        return response()->json(null, 204);
    }
}

