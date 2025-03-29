<?php

namespace App\Services;

use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\EfetivoServidorResource;
use App\Http\Resources\EfetivoServidorCollection;

class EfetivoServidorService
{
    public function listar($servidoresEfetivos): EfetivoServidorCollection
    {
        return new EfetivoServidorCollection($servidoresEfetivos::withRelations()->paginate(5));
    }

    public function inserir($request): PessoaResource | array
    {
        try {

            DB::beginTransaction();

            $pessoa = Pessoa::create($request->validated());

            $pessoa->servidorEfetivo()->create([
                'se_matricula' => $request->safe()->se_matricula
            ]);

            $pessoa->enderecos()->create($request->safe()->only([
                'end_tipo_logradouro',
                'end_logradouro',
                'end_numero',
                'end_bairro',
                'cidade_id'
            ]));

            $pessoa->lotacoes()->create([
                'unidade_id' => $request->safe()->unidade_id,
                'lot_data_lotacao' => $request->safe()->lot_data_lotacao,
                'lot_data_remocao' => $request->safe()->lot_data_remocao,
                'lot_portaria' => $request->safe()->lot_portaria
            ]);

            $pessoa->fotos()->create($request->safe()->only([
                'fp_data',
                'fp_bucket',
                'fp_hash'
            ]));

            DB::commit();

            return new PessoaResource($pessoa->load([
                'servidorEfetivo',
                'enderecos',
                'enderecos.cidade',
                'lotacoes',
                'lotacoes.unidade',
                'fotos'
            ]));

        } catch (\Throwable $th) {

            Log::error('Erro na inserção de servidor efetivo: ' . $th->getMessage());

            return ['message' => 'Erro na inserção de servidor efetivo'];
        }
    }

    public function buscar($servidorEfetivo): EfetivoServidorResource
    {
        return new EfetivoServidorResource($servidorEfetivo);
    }

    public function atualizar($request, $servidorEfetivo): EfetivoServidorResource | array
    {
        try {

            DB::beginTransaction();

           //

            DB::commit();

            return new EfetivoServidorResource($servidorEfetivo);

        } catch (\Throwable $th) {

            Log::error('Erro na atualização de servidor efetivo: ' . $th->getMessage());

            return ['message' => 'Erro na atualização de servidor efetivo'];
        }
    }
}
