<?php

namespace App\Services;

use App\Models\Lotacao;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LotacaoRequest;

class LotacaoService
{
    public function criarLotacao(LotacaoRequest $request): Lotacao
    {
        try {
            DB::beginTransaction();

            $lotacao = Lotacao::create([
                'pes_id' => $request->safe()->pes_id,
                'unid_id' => $request->safe()->unid_id,
                'lot_data_lotacao' => $request->safe()->lot_data_lotacao,
                'lot_data_remocao' => $request->safe()->lot_data_remocao,
                'lot_portaria' => $request->safe()->lot_portaria
            ]);

            DB::commit();

            return $lotacao;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function atualizarLotacao(LotacaoRequest $request, int $lotId): Lotacao
    {
        try {
            DB::beginTransaction();

            $lotacao = Lotacao::findOrFail($lotId);

            $lotacao->update($request->validated());

            DB::commit();

            return $lotacao;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
