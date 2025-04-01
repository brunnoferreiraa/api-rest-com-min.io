<?php

namespace App\Http\Controllers;

use App\Models\ServidorEfetivo;
use Illuminate\Http\Request;
use App\Models\FotoPessoa;
use Storage;

class ServidorEfetivoController extends Controller
{
    public function index()
    {
        return response()->json(ServidorEfetivo::paginate(10));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pes_id' => 'required|exists:pessoa,pes_id',
            'sef_matricula' => 'required|string|max:50',
            'sef_cargo' => 'required|string|max:100',
        ]);

        $servidorEfetivo = ServidorEfetivo::create($request->all());

        return response()->json($servidorEfetivo, 201);
    }

    public function show($id)
    {
        $servidorEfetivo = ServidorEfetivo::findOrFail($id);
        return response()->json($servidorEfetivo);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pes_id' => 'sometimes|exists:pessoas,pes_id',
            'se_matricula' => 'sometimes|string|max:50',
            'unid_id' => 'sometimes|exists:unidades,unid_id'
        ]);

        $servidor = ServidorEfetivo::findOrFail($id);
        $servidor->update($request->all());

        return response()->json($servidor);
    }

    public function destroy($id)
    {
        $servidor = ServidorEfetivo::findOrFail($id);
        $servidor->delete();

        return response()->json(null, 204);
    }

    public function porUnidade($unidade_id)
{
    $servidores = ServidorEfetivo::where('uni_id', $unidade_id)
        ->with(['pessoa', 'lotacao.unidade'])
        ->paginate(10);

    $resultado = $servidores->map(function ($servidor) {
        return [
            'nome' => $servidor->pessoa->pes_nome,
            'idade' => now()->diffInYears($servidor->pessoa->pes_data_nascimento),
            'unidade' => $servidor->lotacao->unidade->uni_nome,
            'foto_url' => $this->getFotoUrl($servidor->pessoa->pes_id)
        ];
    });

    return response()->json($resultado);
}

private function getFotoUrl($pes_id)
{
    $foto = FotoPessoa::where('pes_id', $pes_id)->latest()->first();

    if (!$foto) {
        return null;
    }

}

}