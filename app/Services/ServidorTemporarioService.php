<?php

namespace App\Services;

use App\Models\Pessoa;
use App\Models\Lotacao;
use App\Models\Endereco;
use App\Models\FotoPessoa;
use App\Models\PessoaEndereco;
use App\Models\ServidorTemporario;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServidorTemporarioRequest;

class ServidorTemporarioService
{
    public function criarServidorTemporario(ServidorTemporarioRequest $request): ServidorTemporario
    {
        try {
            DB::beginTransaction();

            $pessoa = Pessoa::create($request->validated());

            $servidor = ServidorTemporario::create([
                'pes_id' => $pessoa->pes_id,
                'st_data_admissao' => $request->safe()->st_data_admissao,
                'st_data_demissao' => $request->safe()->st_data_demissao
            ]);

            $endereco = Endereco::create($request->validated());

            PessoaEndereco::updateOrCreate([
                'pes_id' => $pessoa->pes_id,
                'end_id' => $endereco->end_id
            ]);

            Lotacao::create([
                'pes_id' => $pessoa->pes_id,
                'unid_id' => $request->safe()->unid_id,
                'lot_data_lotacao' => $request->safe()->lot_data_lotacao,
                'lot_data_remocao' => $request->safe()->lot_data_remocao,
                'lot_portaria' => $request->safe()->lot_portaria
            ]);

            DB::commit();

            return $servidor;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function atualizarServidorTemporario(ServidorTemporarioRequest $request, string $servidorId): ServidorTemporario
    {
        try {
            DB::beginTransaction();

            $servidor = ServidorTemporario::findOrFail($servidorId);
            $servidor->update([
                'st_data_admissao' => $request->safe()->st_data_admissao,
                'st_data_demissao' => $request->safe()->st_data_demissao
            ]);

            $pessoa = Pessoa::findOrFail($servidor->pes_id);
            $pessoa->update([
                'pes_nome' => $request->safe()->pes_nome,
                'pes_data_nascimento' => $request->safe()->pes_data_nascimento,
                'pes_sexo' => $request->safe()->pes_sexo,
                'pes_mae' => $request->safe()->pes_mae,
                'pes_pai' => $request->safe()->pes_pai
            ]);

            $endId = PessoaEndereco::where('pes_id', $pessoa->pes_id)->latest()->first()->end_id;
            $endereco = Endereco::findOrFail($endId);
            $endereco->update([
                'end_id' => $endId,
                'end_tipo_logradouro' => $request->safe()->end_tipo_logradouro,
                'end_logradouro' => $request->safe()->end_logradouro,
                'end_numero' => $request->safe()->end_numero,
                'end_bairro' => $request->safe()->end_bairro,
                'cid_id' => $request->safe()->cid_id
            ]);

            $lotacao = Lotacao::where('pes_id', $pessoa->pes_id)->latest()->first();
            $lotacao->update([
                'unid_id' => $request->safe()->unid_id,
                'lot_data_lotacao' => $request->safe()->lot_data_lotacao,
                'lot_data_remocao' => $request->safe()->lot_data_remocao,
                'lot_portaria' => $request->safe()->lot_portaria
            ]);

            DB::commit();

            return $servidor;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
