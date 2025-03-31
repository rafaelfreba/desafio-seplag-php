<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServidorEfetivoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'pes_id' => $this->pessoa->pes_id,
            'nome' => $this->pessoa->pes_nome,
            'mae' => $this->pessoa->pes_mae,
            'pai' => $this->pessoa->pes_pai,
            'se_matricula' => $this->se_matricula,
            'enderecos' => $this->pessoa->enderecos->map(function ($endereco) {
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
            'lotacoes' => $this->pessoa->lotacoes->map(function ($lotacao) {
                return [
                    'lot_id' => $lotacao->lot_id,
                    'unid_id' => $lotacao->unid_id,
                    'unidade' => $lotacao->unidade ? [
                        'unid_id' => $lotacao->unidade->unid_id,
                        'unid_nome' => $lotacao->unidade->unid_nome,
                        'unid_sigla' => $lotacao->unidade->unid_sigla,
                        'endereco' => $lotacao->unidade->enderecos->map(function ($enderecoUnidade) {
                            return [
                                'end_id' => $enderecoUnidade->end_id,
                                'end_tipo_logradouro' => $enderecoUnidade->end_tipo_logradouro,
                                'end_logradouro' => $enderecoUnidade->end_logradouro,
                                'end_numero' => $enderecoUnidade->end_numero,
                                'end_bairro' => $enderecoUnidade->end_bairro,
                                'cidade' => [
                                    'cid_id' => $enderecoUnidade->cidade->cid_id,
                                    'cid_nome' => $enderecoUnidade->cidade->cid_nome,
                                    'cid_uf' => $enderecoUnidade->cidade->cid_uf,
                                ],
                            ];
                        }),
                    ] : null,
                    'lot_data_lotacao' => $lotacao->lot_data_lotacao,
                    'lot_data_remocao' => $lotacao->lot_data_remocao,
                    'lot_portaria' => $lotacao->lot_portaria,
                ];
            }),
            'fotos' => [
                'fp_id' => $this->fp_id,
                'fp_data' => $this->fp_data,
                'fp_bucket' => $this->fp_bucket,
                'fp_hash' => $this->fp_hash,
                'url' => "http://minio:9000/{$this->fp_bucket}/{$this->fp_hash}",
            ],
        ];
    }
}
