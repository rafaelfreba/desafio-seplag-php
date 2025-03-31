<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorPorUnidadeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'pes_nome' => $this->pessoa ? $this->pessoa->pes_nome : null,
            'pes_data_nascimento' => $this->pessoa ? $this->pessoa->pes_data_nascimento : null,
            'lotacao' => $this->pessoa ? $this->pessoa->lotacoes->map(function ($lotacao) {
                return [
                    'unid_nome' => $lotacao->unidade->unid_nome ?? null,
                    'unid_sigla' => $lotacao->unidade->unid_sigla ?? null,
                ];
            }) : [],
            'fotos' => $this->pessoa && $this->pessoa->fotos->first() ? [
                'fp_data' => $this->pessoa->fotos->first()->fp_data,
                'fp_link' => 'vem do min io expira em 5min'
            ] : [],
        ];
    }
}
