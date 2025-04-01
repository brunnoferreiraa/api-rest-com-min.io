<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\FotoPessoa;

class FotoPessoaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'pes_id' => 'required|exists:pessoas,pes_id',
            'foto' => 'required|image|max:2048' // Limite de 2MB
        ]);

        // Armazena a imagem no MinIO
        $path = $request->file('foto')->store('fotos_pessoas', 'minio');

        // Cria um registro no banco de dados
        $foto = FotoPessoa::create([
            'pes_id' => $request->pes_id,
            'fp_bucket' => env('AWS_BUCKET'),
            'fp_hash' => $path,
            'fp_data' => now(),
        ]);

        return response()->json(['message' => 'Imagem enviada com sucesso', 'foto' => $foto], 201);
    }

    public function getUrl($id)
    {
        $foto = FotoPessoa::findOrFail($id);

        // Gera uma URL temporária válida por 5 minutos (300 segundos)
        $url = Storage::disk('minio')->temporaryUrl(
            $foto->fp_hash, now()->addMinutes(5)
        );

        return response()->json(['url' => $url]);
    }
}
