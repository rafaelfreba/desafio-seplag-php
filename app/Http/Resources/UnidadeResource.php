<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'unid_id' => $this->unid_id,
            'unid_nome' => $this->unid_nome,
            'unid_sigla' => $this->unid_sigla,
            'enderecos' => $this->enderecos->map(function ($endereco) {
                return [
                    'end_id' => $endereco->end_id,
                    'end_tipo_logradouro' => $endereco->end_tipo_logradouro,
                    'end_logradouro' => $endereco->end_logradouro,
                    'end_numero' => $endereco->end_numero,
                    'end_bairro' => $endereco->end_bairro,
                    'cidade' => [
                        'cid_id' => $endereco->cidade->cid_id,
                        'cid_nome' => $endereco->cidade->cid_nome,
                        'cid_uf' => $endereco->cidade->cid_uf,
                    ],
                ];
            }),
        ];
    }
}
