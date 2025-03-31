<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServidorEfetivo;
use Illuminate\Http\JsonResponse;
use App\Services\ServidorEfetivoService;
use App\Http\Requests\ServidorEfetivoRequest;
use App\Http\Resources\ServidorEfetivoResource;
use App\Http\Resources\ServidorEfetivoCollection;

class ServidorEfetivoController extends Controller
{
    public function __construct(protected ServidorEfetivoService $service) {}

    public function index(Request $request)
    {
        if(!$request->query('unid_id') && !$request->query('nome')){
            return new ServidorEfetivoCollection(ServidorEfetivo::withRelations()->paginate(5));
        }

        // if($request->filled('unid_id')){
        //     return $this->service->retornaServidoresDaUnidade($request->unid_id);        
        // }
        
        if($request->filled('nome')){
            return $this->service->retornaEnderecoFuncionalServidor($request->nome);        
        }
    }

    public function store(ServidorEfetivoRequest $request): ServidorEfetivoResource | JsonResponse
    {
        try {
            $servidor = $this->service->criarServidorEfetivo($request);
            return response()->json([
                'mensagem' => 'Servidor efetivo criado com sucesso',
                'dados' => new ServidorEfetivoResource($servidor)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na criação do servidor efetivo'], 404);
        }
    }

    public function show(int $servidorId): ServidorEfetivoResource | JsonResponse
    {
        try {
            $servidor = ServidorEfetivo::findOrFail($servidorId);
            return new ServidorEfetivoResource($servidor);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Registro não encontrado'], 404);
        }
    }

    public function update(ServidorEfetivoRequest $request, string $servidorId): ServidorEfetivoResource |JsonResponse
    {
        try {
            $servidor = $this->service->atualizarServidorEfetivo($request, $servidorId);
            return response()->json([
                'mensagem' => 'Servidor efetivo atualizado com sucesso',
                'dados' => new ServidorEfetivoResource($servidor)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro na atualização do servidor efetivo'], 500);
        }
    }
}