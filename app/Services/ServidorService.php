<?php

namespace App\Services;

use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\ServidorCollection;
use App\Http\Resources\ServidorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ServidorService
{
    public function __construct(
        protected EfetivoServidorService $efetivoServidorService, 
        protected ServidorTemporarioService $servidorTemporarioService)
    {
    }

    public function listar($routeName, $unidadeId)
    {
        try {
            if ($routeName == 'efetivos') {
                $servidores = $this->efetivoServidorService->listar($unidadeId);
                return new ServidorCollection($servidores);
            }

            if ($routeName == 'temporarios') {
                $servidores = $this->servidorTemporarioService->listar($unidadeId);
                return new ServidorCollection($servidores);
            }

            return response()->json(['message' => 'Rota inválida'], 400);

        } catch (ModelNotFoundException $e) {
            
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function inserir($request): PessoaResource | array
    {
        try {

            DB::beginTransaction();

            $pessoa = Pessoa::create($request->validated());

            if ($request->filled('se_matricula')) {
                $pessoa->servidorEfetivo()->create([
                    'se_matricula' => $request->safe()->se_matricula
                ]);
            }

            if (!$request->filled('se_matricula')) {
                $pessoa->servidorTemporario()->create([
                    'st_data_admissao' => $request->safe()->st_data_admissao,
                    'st_data_demissao' => $request->safe()->st_data_demissao
                ]);
            }

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

            Log::error('Erro na inserção de servidor: ' . $th->getMessage());

            return ['mensagem' => 'Erro na inserção de servidor'];
        }
    }

    public function buscar($routeName, $servidorId): ServidorResource | JsonResponse
    {
        try {
            if ($routeName == 'efetivo') {
                $servidor = $this->efetivoServidorService->buscar($servidorId);
                return new ServidorResource($servidor);
            }

            if ($routeName == 'temporario') {
                $servidor = $this->servidorTemporarioService->buscar($servidorId);
                return new ServidorResource($servidor);
            }

            return response()->json(['message' => 'Rota inválida.'], 400);

        } catch (ModelNotFoundException $e) {
            
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function atualizar($request, $servidor): ServidorResource | array
    {
        try {

            DB::beginTransaction();

            //

            DB::commit();

            return new ServidorResource($servidor);
        } catch (\Throwable $th) {

            Log::error('Erro na atualização de servidor: ' . $th->getMessage());

            return ['mensagem' => 'Erro na atualização de servidor'];
        }
    }
}
