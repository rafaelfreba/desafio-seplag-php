<?php

namespace App\Services;

use App\Models\Unidade;
use App\Models\Endereco;
use App\Models\UnidadeEndereco;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UnidadeRequest;

class UnidadeService
{
    public function criarUnidade(UnidadeRequest $request): Unidade
    {
        try {
            DB::beginTransaction();

            $unidade = Unidade::create($request->validated());

            $endereco = Endereco::create($request->validated());

            UnidadeEndereco::updateOrCreate([
                'unid_id' => $unidade->unid_id,
                'end_id' => $endereco->end_id
            ]);

            DB::commit();

            return $unidade;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function atualizarUnidade(UnidadeRequest $request, int $unidId): Unidade
    {
        try {
            DB::beginTransaction();

            $unidade = Unidade::findOrFail($unidId);
            $unidade->update([
                'unid_nome' => $request->safe()->unid_nome,
                'unid_sigla' => $request->safe()->unid_sigla
            ]);

            $endId = UnidadeEndereco::where('unid_id', $unidade->unid_id)->latest()->first()->end_id;
            $endereco = Endereco::findOrFail($endId);
            $endereco->update([
                'end_id' => $endId,
                'end_tipo_logradouro' => $request->safe()->end_tipo_logradouro,
                'end_logradouro' => $request->safe()->end_logradouro,
                'end_numero' => $request->safe()->end_numero,
                'end_bairro' => $request->safe()->end_bairro,
                'cid_id' => $request->safe()->cid_id
            ]);

            DB::commit();

            return $unidade;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}