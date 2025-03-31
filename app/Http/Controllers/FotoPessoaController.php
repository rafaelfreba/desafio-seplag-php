<?php

namespace App\Http\Controllers;

use App\Http\Requests\FotoPessoaRequest;
use App\Models\FotoPessoa;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FotoPessoaController extends Controller
{
    public function upload(FotoPessoaRequest $request, $pes_id)
    {
        $pessoa = Pessoa::findOrFail($pes_id);

        $fileName = Str::uuid() . '.' . $request->foto->extension();

        $path = Storage::disk('s3')->put("fotos/{$fileName}", $request->foto, 'public');
        $foto = FotoPessoa::create([
            'pes_id' => $pessoa->pes_id,
            'fp_bucket' => env('AWS_BUCKET'),
            'fp_hash' => $fileName,
            'fp_data' => now(),
        ]);

        return response()->json([
            'message' => 'Foto enviada com sucesso!',
            'foto_url' => Storage::disk('s3')->url($path),
        ]);
    }
}
