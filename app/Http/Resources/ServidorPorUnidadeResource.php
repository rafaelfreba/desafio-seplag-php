<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorPorUnidadeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nome' => $this->pes_nome,
            'idade' => calculaIdade($this->pes_data_nascimento),
            'unidade' => $this->servidorEfetivo->lotacao->unidade->unid_nome ?? null,
            'foto' => $this->foto ? asset('caminho_para_fotos/' . $this->fotos->fp_hash) : null,
        ];
    }
}
