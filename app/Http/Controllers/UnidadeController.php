<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Services\UnidadeService;
use App\Http\Requests\UnidadeRequest;
use App\Http\Resources\UnidadeResource;
use App\Http\Resources\UnidadeCollection;

class UnidadeController extends Controller
{
    public function __construct(protected UnidadeService $service) {}

    public function index(Unidade $unidades): UnidadeCollection
    {
        return $this->service->listar($unidades);
    }

    public function store(UnidadeRequest $request): UnidadeResource
    {
        return $this->service->inserir($request->validated());
    }

    public function show(Unidade $unidade): UnidadeResource
    {
        return $this->service->buscar($unidade);
    }

    public function update(UnidadeRequest $request, Unidade $unidade): UnidadeResource
    {
        return $this->service->atualizar($request, $unidade);
    }
}
