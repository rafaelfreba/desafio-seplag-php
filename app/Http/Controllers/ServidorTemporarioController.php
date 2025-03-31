<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\ServidorTemporario;
use App\Services\ServidorTemporarioService;
use App\Http\Requests\ServidorTemporarioRequest;
use App\Http\Resources\ServidorTemporarioResource;
use App\Http\Resources\ServidorTemporarioCollection;

class ServidorTemporarioController extends Controller
{
    public function __construct(protected ServidorTemporarioService $service) {}

    public function index()
    {
        return new ServidorTemporarioCollection(ServidorTemporario::withRelations()->paginate(5));
    }

    public function store(ServidorTemporarioRequest $request): ServidorTemporarioResource | JsonResponse
    {
        try {
            $servidor = $this->service->criarServidorTemporario($request);
            return response()->json([
                'mensagem' => 'Servidor temporário criado com sucesso',
                'dados' => new ServidorTemporarioResource($servidor)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na criação do servidor temporário'], 404);
        }
    }

    public function show(int $servidorId): ServidorTemporarioResource | JsonResponse
    {
        try {
            $servidor = ServidorTemporario::findOrFail($servidorId);
            return new ServidorTemporarioResource($servidor);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Registro não encontrado'], 404);
        }
    }

    public function update(ServidorTemporarioRequest $request, string $servidorId): ServidorTemporarioResource |JsonResponse
    {
        try {
            $servidor = $this->service->atualizarServidorTemporario($request, $servidorId);
            return response()->json([
                'mensagem' => 'Servidor temporário atualizado com sucesso',
                'dados' => new ServidorTemporarioResource($servidor)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na atualização do servidor temporário'], 500);
        }
    }
}