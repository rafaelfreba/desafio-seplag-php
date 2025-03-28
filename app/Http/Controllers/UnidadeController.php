<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Http\Requests\UnidadeRequest;
use Illuminate\Database\Eloquent\Collection;

class UnidadeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/unidades",
     *     summary="Lista todas as unidades",
     *     description="Retorna todas as unidades cadastradas no sistema.",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição",
     *     )
     * )
     * 
     * Lista todas as unidades
     *
     * @param Unidade $unidades
     * @return Collection
     */
    public function index(Unidade $unidades): Collection
    {
        return $unidades->all();
    }

    /**
     *@OA\Post(
     *     path="/api/unidades",
     *     summary="Cadastra uma nova unidade",
     *     description="Cria uma nova unidade com os dados fornecidos.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *             @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição (dados inválidos)",
     *     )
     * )
     * 
     *  Cadastra uma nova unidade
     *
     * @param UnidadeRequest $request
     * @return Unidade
     */
    public function store(UnidadeRequest $request): Unidade
    {
        return Unidade::create($request->validated());
    }

    /**
     * @OA\Get(
     *     path="/api/unidades/{id}",
     *     summary="Exibe uma unidade especificada",
     *     description="Retorna os detalhes de uma unidade com o ID fornecido.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da unidade",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *             @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Unidade não encontrada",
     *     )
     * )
     * 
     * Exibe uma unidade especificada
     *
     * @param Unidade $unidade
     * @return Unidade
     */
    public function show(Unidade $unidade): Unidade
    {
        return $unidade;
    }

    /**
     * @OA\Put(
     *     path="/api/unidades/{id}",
     *     summary="Atualiza uma unidade especificada",
     *     description="Atualiza os dados de uma unidade existente com os dados fornecidos.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da unidade",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *             @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *             @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição (dados inválidos)",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No query results for model [App\\Models\\Unidade] [id]",
     *     )
     * )
     * Atualiza uma unidade especificada
     *
     * @param UnidadeRequest $request
     * @param Unidade $unidade
     * @return Unidade
     */
    public function update(UnidadeRequest $request, Unidade $unidade): Unidade
    {
        $unidade->update($request->validated());

        return $unidade;
    }

    /**
     * @OA\Delete(
     *     path="/api/unidades/{id}",
     *     summary="Remove uma unidade especificada",
     *     description="Remove a unidade com o ID fornecido.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da unidade",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *              @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *          @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No query results for model [App\\Models\\Unidade] [id]",
     *     )
     * )
     * Remove uma unidade especificada
     *
     * @param Unidade $unidade
     * @return array
     */
    public function destroy(Unidade $unidade): array
    {
        $unidade->delete();

        return ['message' => 'Unidade removida com sucesso!'];
    }
}
