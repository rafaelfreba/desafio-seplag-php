<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PessoaResource extends JsonResource
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
            'pes_nome' => $this->pes_nome,
            'pes_data_nascimento' => $this->pes_data_nascimento,
            'pes_sexo' => $this->pes_sexo,
            'pes_mae' => $this->pes_mae,
            'pes_pai' => $this->pes_pai,
            'se_matricula' => $this->servidorEfetivo->se_matricula ?? null,

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

            'lotacoes' => $this->lotacoes->map(function ($lotacao) {
                return [
                    'lot_data_lotacao' => $lotacao->lot_data_lotacao,
                    'lot_data_remocao' => $lotacao->lot_data_remocao ?? null,
                    'lot_portaria' => $lotacao->lot_portaria,
                    'unidade' => [
                        'unid_nome' => $lotacao->unidade->unid_nome ?? null,
                        'unid_sigla' => $lotacao->unidade->unid_sigla ?? null,
                    ],
                ];
            }),

            // 'fotos' => $this->fotoPessoa ? [
            //     'fp_data' => $this->fotoPessoa->fp_data,
            //     'fp_link' => 'vem do min io expira em 5min'
            // ] : null,
        ];
    }
}
