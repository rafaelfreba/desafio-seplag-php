<?php

namespace App\Http\Controllers;

use App\Models\Lotacao;
use App\Services\LotacaoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LotacaoRequest;
use App\Http\Resources\LotacaoResource;
use App\Http\Resources\LotacaoCollection;

class LotacaoController extends Controller
{
    public function __construct(protected LotacaoService $service)
    {}
    
    public function index(Lotacao $lotacoes): LotacaoCollection
    {
        return new LotacaoCollection($lotacoes::with(['pessoa', 'unidade'])->paginate(5));
    }

    public function store(LotacaoRequest $request): JsonResponse
    {
        try {
            $lotacao = $this->service->criarLotacao($request);

            return response()->json([
                'mensagem' => 'Lotação criada com sucesso',
                'dados' => new LotacaoResource($lotacao)
            ], 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(['mensagem' => 'Erro na inserção da lotacao'], 404);
        }
    }

    public function show(int $lotId): LotacaoResource | JsonResponse
    {
        try {
            $lotacao = Lotacao::findOrFail($lotId);
            return new LotacaoResource($lotacao);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Registro não encontrado'], 404);
        }
    }

    public function update(LotacaoRequest $request, int $lotId): JsonResponse
    {
        try {
            $lotacao = $this->service->atualizarLotacao($request, $lotId);

            return response()->json([
                'mensagem' => 'Lotação atualizada com sucesso',
                'dados' => new LotacaoResource($lotacao)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na atualização da lotação'], 404);
        }
    }
}
