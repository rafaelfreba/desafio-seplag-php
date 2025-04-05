<?php

namespace App\Http\Controllers;

use App\Models\FotoPessoa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FotoPessoaRequest;
use Illuminate\Http\Request;

class FotoPessoaController extends Controller
{
    public function upload(Request $request, $id)
    {
        if ($request->hasFile('foto')) {
            $arquivo = $request->file('foto');
            $nomeOriginal = $arquivo->getClientOriginalName();
            $timestamp = now()->timestamp;
            $caminhoNoMinio = 'pessoas/' . $id . '/' . $timestamp . '_' . Str::slug(pathinfo($nomeOriginal, PATHINFO_FILENAME)) . '.' . $arquivo->getClientOriginalExtension();

            try {
                Storage::disk('s3')->put($caminhoNoMinio, file_get_contents($arquivo));
                $hash = hash_file('md5', $arquivo->getRealPath());

                FotoPessoa::create([
                    'pes_id' => $id,
                    'fp_data' => now(),
                    'fp_bucket' => $caminhoNoMinio,
                    'fp_hash' => $hash,
                ]);

                return response()->json([
                    'mensagem' => 'Upload da foto realizado com sucesso!',
                    'caminho' => $caminhoNoMinio
                ]);
            } catch (\Exception $e) {
                Log::error('Erro ao enviar para MinIO:', ['exception' => $e]);
                return response()->json(['erro' => 'Erro ao enviar a foto.'], 500);
            }
        } else {
            return response()->json(['erro' => 'Nenhuma foto foi enviada.'], 400);
        }
    }

    public function getFoto(int $pes_id)
    {
       $foto = FotoPessoa::where('pes_id', $pes_id)->latest('fp_data')->first();

        if (!$foto) {
            return response()->json(['message' => 'Foto não encontrada.'], 404);
        }

        try {
            $url = Storage::disk('s3')->temporaryUrl(
                $foto->fp_bucket,
                now()->addMinutes(5)
            );

            return response()->json(['url' => $url]);

        } catch (\Exception $e) {
            Log::error('Erro ao gerar URL temporária:', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao gerar o link da foto.'], 500);
        }
    }
}
