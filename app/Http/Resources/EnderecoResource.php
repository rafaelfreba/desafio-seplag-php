<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'unidades' => $this->unidades->map(function ($unidade) {
                return [
                    'nome' => $unidade->unid_nome,
                    'sigla' => $unidade->unid_sigla,
                ];
            }),
            'tipo_logradouro' => $this->end_tipo_logradouro,
            'logradouro' => $this->end_logradouro,
            'numero' => $this->end_numero,
            'bairro' => $this->end_bairro,
            'cidade' => [
                'nome' => $this->cidade->cid_nome ?? null,
                'uf' => $this->cidade->cid_uf ?? null,
            ],            
        ];
    }
}
