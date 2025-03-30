<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pes_nome' => $this->pessoa ? $this->pessoa->pes_nome : null,
            'pes_data_nascimento' => $this->pessoa ? $this->pessoa->pes_data_nascimento : null,
            'pes_sexo' => $this->pessoa ? $this->pessoa->pes_sexo : null,
            'pes_mae' => $this->pessoa ? $this->pessoa->pes_mae : null,
            'pes_pai' => $this->pessoa ? $this->pessoa->pes_pai : null,
            'se_matricula' => $this->se_matricula ?? null,
            'st_data_admissao' => $this->st_data_admissao ?? null,
            'st_data_demissao' => $this->st_data_demissao ?? null,
            'enderecos' => $this->pessoa ? $this->pessoa->enderecos->map(function ($endereco) {
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
            }) : [],
            'lotacoes' => $this->pessoa ? $this->pessoa->lotacoes->map(function ($lotacao) {
                return [
                    'lot_data_lotacao' => $lotacao->lot_data_lotacao,
                    'lot_data_remocao' => $lotacao->lot_data_remocao ?? null,
                    'lot_portaria' => $lotacao->lot_portaria,
                    'unidade' => [
                        'unid_nome' => $lotacao->unidade->unid_nome ?? null,
                        'unid_sigla' => $lotacao->unidade->unid_sigla ?? null,
                    ],
                ];
            }) : [],
            'fotos' => $this->pessoa && $this->pessoa->fotos->first() ? [
                'fp_data' => $this->pessoa->fotos->first()->fp_data,
                'fp_link' => 'vem do min io expira em 5min'
            ] : [],
        ];
    }
}
