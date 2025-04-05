<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorPorUnidadeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->pes_nome,
            'idade' => calculaIdade($this->pes_data_nascimento),
            'unidade' => $this->servidorEfetivo->lotacao->unidade->unid_nome ?? null,
            'foto' => isset($this->foto->fp_bucket) ? Storage::disk('s3')->temporaryUrl(
                $this->foto->fp_bucket,
                now()->addMinutes(5)
            ) : null
        ];
    }
}
