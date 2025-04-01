<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Models\Pessoa;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Endereco::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'end_tipo_logradouro' => 'nullable|string|max:50',
            'end_logradouro' => 'nullable|string|max:200',
            'end_numero' => 'nullable|integer',
            'end_bairro' => 'nullable|string|max:100',
            'cid_id' => 'nullable|exists:cidade,cid_id'

        ]);
        $endereco = Endereco::create($request->all());
        return response()->json($endereco, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $endereco = Endereco::findOrFail($id);
        return response()->json($endereco);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'end_tipo_logradouro' => 'nullable|string|max:50',
            'end_logradouro' => 'nullable|string|max:200',
            'end_numero' => 'nullable|integer',
            'end_bairro' => 'nullable|string|max:100',
            'cid_id' => 'nullable|exists:cidade,cid_id'
        ]);

        $endereco = Endereco::findOrFail($id);
        $endereco->update($request->all());

        return response()->json($endereco);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $endereco = Endereco::findOrFail($id);
        $endereco->delete();

        return response()->json(null, 204);
    }

    public function buscarPorNome(Request $request)
{
    $request->validate([
        'nome' => 'required|string|min:3'
    ]);

    $servidores = Pessoa::where('pes_nome', 'ILIKE', '%' . $request->nome . '%')
        ->with(['enderecos'])
        ->get();

    $resultado = $servidores->map(function ($pessoa) {
        return [
            'nome' => $pessoa->pes_nome,
            'enderecos' => $pessoa->enderecos->map(function ($endereco) {
                return [
                    'logradouro' => $endereco->end_logradouro,
                    'numero' => $endereco->end_numero,
                    'bairro' => $endereco->end_bairro,
                    'cidade' => $endereco->cidade->cid_nome ?? null
                ];
            })
        ];
    });

    return response()->json($resultado);
}

}
