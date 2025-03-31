<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Services\UnidadeService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UnidadeRequest;
use App\Http\Resources\UnidadeResource;
use App\Http\Resources\UnidadeCollection;

class UnidadeController extends Controller
{
    public function __construct(protected UnidadeService $service) {}

    public function index(): UnidadeCollection
    {
        return new UnidadeCollection(Unidade::with(['enderecos', 'enderecos.cidade'])->paginate(5));
    }

    public function store(UnidadeRequest $request): JsonResponse
    {
        try {
            $unidade = $this->service->criarUnidade($request);

            return response()->json([
                'mensagem' => 'Unidade criada com sucesso',
                'dados' => new UnidadeResource($unidade)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na inserção da unidade'], 404);
        }
    }

    public function show(int $unidId): UnidadeResource | JsonResponse
    {
        try {
            $unidade = Unidade::findOrFail($unidId);
            return new UnidadeResource($unidade);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Registro não encontrado'], 404);
        }
    }

    public function update(UnidadeRequest $request, int $unidId): JsonResponse
    {
        try {
            $unidade = $this->service->atualizarUnidade($request, $unidId);

            return response()->json([
                'mensagem' => 'Unidade atualizada com sucesso',
                'dados' => new UnidadeResource($unidade)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na atualização da unidade'], 404);
        }
    }
}