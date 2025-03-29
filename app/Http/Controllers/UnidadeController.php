<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Endereco;
use App\Http\Requests\UnidadeRequest;
use App\Http\Resources\UnidadeResource;
use App\Http\Resources\UnidadeCollection;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Authenticatable;

class UnidadeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/unidades",
     *     summary="Lista todas as unidades",
     *     description="Retorna todas as unidades cadastradas no sistema.",
     *     tags={"Unidades"},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index(Unidade $unidades): UnidadeCollection
    {
        return new UnidadeCollection($unidades::with(['enderecos', 'enderecos.cidade'])->paginate(5));
    }

    /**
     *@OA\Post(
     *     path="/api/unidades",
     *     summary="Cadastra uma nova unidade",
     *     description="Cria uma nova unidade com os dados fornecidos.",
     *     tags={"Unidades"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *                 @OA\Property(property="end_tipo_logradouro", type="string", description="Tipo de logradouro", example="Avenida"),
     *                 @OA\Property(property="end_logradouro", type="string", description="Logradouro", example="Alzira Santana"),
     *                 @OA\Property(property="end_numero", type="integer", description="Número", example="100"),
     *                 @OA\Property(property="end_bairro", type="integer", description="Bairro", example="Centro"),
     *                 @OA\Property(property="cidade_id", type="integer", description="Id da Cidade", example="1"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="created",
     *         @OA\JsonContent(
     *             type="object",
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *                 @OA\Property(property="end_tipo_logradouro", type="string", description="Tipo de logradouro", example="Avenida"),
     *                 @OA\Property(property="end_logradouro", type="string", description="Logradouro", example="Alzira Santana"),
     *                 @OA\Property(property="end_numero", type="integer", description="Número", example="100"),
     *                 @OA\Property(property="end_bairro", type="integer", description="Bairro", example="Centro"),
     *                 @OA\Property(property="cidade_id", type="integer", description="Id da Cidade", example="1"),
     *         )
     *     )
     * )
     */
    public function store(UnidadeRequest $request): UnidadeResource
    {
        $unidade = Unidade::create($request->validated());

        $endereco = Endereco::create($request->validated());

        $unidade->enderecos()->attach($endereco->id);

        return new UnidadeResource($unidade->load(['enderecos', 'enderecos.cidade']));
    }

    /**
     * @OA\Get(
     *     path="/api/unidades/{id}",
     *     summary="Exibe uma unidade especificada",
     *     description="Retorna os detalhes de uma unidade com o ID fornecido.",
     *     tags={"Unidades"},
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
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *                 @OA\Property(property="end_tipo_logradouro", type="string", description="Tipo de logradouro", example="Avenida"),
     *                 @OA\Property(property="end_logradouro", type="string", description="Logradouro", example="Alzira Santana"),
     *                 @OA\Property(property="end_numero", type="integer", description="Número", example="100"),
     *                 @OA\Property(property="end_bairro", type="integer", description="Bairro", example="Centro"),
     *                 @OA\Property(property="cidade_id", type="integer", description="Id da Cidade", example="1"),
     *         )
     *     )
     * )
     */
    public function show(Unidade $unidade): UnidadeResource
    {
        return new UnidadeResource($unidade->load(['enderecos', 'enderecos.cidade']));
    }

    /**
     * @OA\Put(
     *     path="/api/unidades/{id}",
     *     summary="Atualiza uma unidade especificada",
     *     description="Atualiza os dados de uma unidade existente com os dados fornecidos.",
     *     tags={"Unidades"},
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
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *                 @OA\Property(property="end_tipo_logradouro", type="string", description="Tipo de logradouro", example="Avenida"),
     *                 @OA\Property(property="end_logradouro", type="string", description="Logradouro", example="Alzira Santana"),
     *                 @OA\Property(property="end_numero", type="integer", description="Número", example="100"),
     *                 @OA\Property(property="end_bairro", type="integer", description="Bairro", example="Centro"),
     *                 @OA\Property(property="cidade_id", type="integer", description="Id da Cidade", example="1"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="object",
     *                 @OA\Property(property="unid_nome", type="string", description="Nome da unidade", example="Unidade A"),
     *                 @OA\Property(property="unid_sigla", type="string", description="Sigla da unidade", example="AAA"),
     *                 @OA\Property(property="end_tipo_logradouro", type="string", description="Tipo de logradouro", example="Avenida"),
     *                 @OA\Property(property="end_logradouro", type="string", description="Logradouro", example="Alzira Santana"),
     *                 @OA\Property(property="end_numero", type="integer", description="Número", example="100"),
     *                 @OA\Property(property="end_bairro", type="integer", description="Bairro", example="Centro"),
     *                 @OA\Property(property="cidade_id", type="integer", description="Id da Cidade", example="1"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No query results for model [App\\Models\\Unidade] [id]",
     *     )
     * )
     */
    public function update(UnidadeRequest $request, Unidade $unidade): UnidadeResource
    {
        $unidade->update($request->validated());

        $endereco = Endereco::updateOrCreate(
            [
                'end_tipo_logradouro' => $request->safe()->end_tipo_logradouro,
                'end_logradouro' => $request->safe()->end_logradouro,
                'end_numero' => $request->safe()->end_numero,
                'end_bairro' => $request->safe()->end_bairro,
                'cidade_id' => $request->safe()->cidade_id,
            ]
        );

        $unidade->enderecos()->sync([$endereco->id]);

        return new UnidadeResource($unidade->load(['enderecos', 'enderecos.cidade']));
    }

    /**
     * @OA\Delete(
     *     path="/api/unidades/{id}",
     *     summary="Remove uma unidade especificada",
     *     description="Remove a unidade com o ID fornecido.",
     *     tags={"Unidades"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da unidade",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No query results for model [App\\Models\\Unidade] [id]",
     *     )
     * )
     */
    public function destroy(Unidade $unidade): array
    {
        $unidade->delete();

        return ['message' => 'Unidade removida com sucesso!'];
    }
}
