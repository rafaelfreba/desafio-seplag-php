<?php

namespace App\Services;

use App\Models\Pessoa;
use App\Models\Lotacao;
use App\Models\Endereco;
use App\Models\FotoPessoa;
use App\Models\PessoaEndereco;
use App\Models\ServidorEfetivo;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ServidorEfetivoRequest;
use App\Http\Resources\EnderecoResource;
use App\Http\Resources\ServidorPorUnidadeCollection;
use App\Models\Unidade;
use App\Models\UnidadeEndereco;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServidorEfetivoService
{
    public function criarServidorEfetivo(ServidorEfetivoRequest $request): ServidorEfetivo
    {
        try {
            DB::beginTransaction();

            $pessoa = Pessoa::create($request->validated());

            $servidor = ServidorEfetivo::create([
                'pes_id' => $pessoa->pes_id,
                'se_matricula' => $request->safe()->se_matricula
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

    public function atualizarServidorEfetivo(ServidorEfetivoRequest $request, string $servidorId): ServidorEfetivo
    {
        try {
            DB::beginTransaction();

            $servidor = ServidorEfetivo::findOrFail($servidorId);
            $servidor->update([
                'se_matricula' => $request->safe()->se_matricula
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

    public function retornaServidoresDaUnidade(int $unidId)
    {
        $pessoas = Pessoa::whereHas('servidorEfetivo.lotacao.unidade', function ($query) use ($unidId) {
            $query->where('unid_id', $unidId);
        })
        ->with([
            'servidorEfetivo.lotacao.unidade' => function ($query) {
                $query->select('unid_id', 'unid_nome');
            },
            'foto' => function ($query) {
                $query->select('pes_id', 'fp_bucket')->orderBy('fp_data', 'desc');
            }
        ])
        ->select('pes_id', 'pes_nome', 'pes_data_nascimento')
        ->distinct()
        ->paginate(5);

    return new ServidorPorUnidadeCollection($pessoas);
    }

    public function retornaEnderecoFuncionalServidor(string $nome)
    {
        $pessoa = Pessoa::where('pes_nome', 'like', '%' . $nome . '%')->first();

        if (!$pessoa) {
            throw new ModelNotFoundException('Servidor efetivo não encontrado');
        }

        $lotacao = Lotacao::where('pes_id', $pessoa->pes_id)->latest()->first();
        if (!$lotacao) {
            throw new ModelNotFoundException('Lotação não encontrada');
        }

        $unidade = Unidade::with('enderecos.cidade')->find($lotacao->unid_id);
        if (!$unidade) {
            throw new ModelNotFoundException('Unidade não encontrada');
        }

        return EnderecoResource::collection($unidade->enderecos);
    }
}
