<?php

namespace App\Services;

use App\Models\Unidade;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UnidadeResource;
use App\Http\Resources\UnidadeCollection;

class UnidadeService
{
    public function listar($unidades): UnidadeCollection
    {
        return new UnidadeCollection($unidades::with(['enderecos', 'enderecos.cidade'])->paginate(5));
    }

    public function inserir(array $dados): UnidadeResource | array
    {
        try {

            DB::beginTransaction();
            
            $unidade = Unidade::create($dados);

            $endereco = Endereco::create($dados);

            $unidade->enderecos()->attach($endereco->id);

            DB::commit();

            return new UnidadeResource($unidade->load(['enderecos', 'enderecos.cidade']));
            
        } catch (\Throwable $th) {

            Log::error('Erro na inserção de unidade: ' . $th->getMessage());

            return ['mensagem' => 'Erro na inserção de unidade'];
        }
    }

    public function buscar($unidade): UnidadeResource
    {
        return new UnidadeResource($unidade);
    }

    public function atualizar($request, $unidade): UnidadeResource | array
    {
        try {

            DB::beginTransaction();

            $unidade->update($request->validated());

            $endereco = Endereco::updateOrCreate(
                [
                    'end_tipo_logradouro' => $request->safe()->end_tipo_logradouro,
                    'end_logradouro' => $request->safe()->end_logradouro,
                    'end_numero' => $request->safe()->end_numero,
                    'end_bairro' => $request->safe()->end_bairro,
                    'cidade_id' => $request->safe()->cidade_id,
                ]
            );

            $unidade->enderecos()->sync([$endereco->id]);

            DB::commit();

            return new UnidadeResource($unidade->load(['enderecos', 'enderecos.cidade']));

        } catch (\Throwable $th) {

            Log::error('Erro na atualização de unidade: ' . $th->getMessage());

            return ['mensagem' => 'Erro na atualização de unidade'];
        }
    }
}
