<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'unid_nome' => $this->unid_nome,
            'unid_sigla' => $this->unid_sigla,
            'enderecos' => $this->enderecos->map(function ($endereco) {
                return [
                    'end_tipo_logradouro' => $endereco->end_tipo_logradouro,
                    'end_logradouro' => $endereco->end_logradouro,
                    'end_numero' => $endereco->end_numero,
                    'end_bairro' => $endereco->end_bairro,
                    'cidade' => [
                        'cid_nome' => $endereco->cidade->cid_nome ?? null,
                        'cid_uf' => $endereco->cidade->cid_uf ?? null,
                    ],
                ];
            }),
        ];
    }
}
