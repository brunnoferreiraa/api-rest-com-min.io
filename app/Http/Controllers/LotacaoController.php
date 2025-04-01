<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    public function index()
    {
        return response()->json(Lotacao::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unid_id' => 'required|exists:unidade,unid_id',
            'servidor_efetivo_id' => 'nullable|exists:servidor_efetivo,sef_id',
            'servidor_temporario_id' => 'nullable|exists:servidor_temporario,ste_id',
        ]);

        $lotacao = Lotacao::create($request->all());

        return response()->json($lotacao, 201);
    }

    public function show($id)
    {
        $lotacao = Lotacao::findOrFail($id);
        return response()->json($lotacao);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unid_id' => 'nullable|exists:unidade,unid_id',
            'servidor_efetivo_id' => 'nullable|exists:servidor_efetivo,sef_id',
            'servidor_temporario_id' => 'nullable|exists:servidor_temporario,ste_id',
        ]);

        $lotacao = Lotacao::findOrFail($id);
        $lotacao->update($request->all());

        return response()->json($lotacao);
    }

    public function destroy($id)
    {
        $lotacao = Lotacao::findOrFail($id);
        $lotacao->delete();

        return response()->json(null, 204);
    }
}

