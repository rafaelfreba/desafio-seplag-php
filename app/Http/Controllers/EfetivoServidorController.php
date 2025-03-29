<?php

namespace App\Http\Controllers;

use App\Models\EfetivoServidor;
use App\Http\Resources\PessoaResource;
use App\Services\EfetivoServidorService;
use App\Http\Requests\EfetivoServidorRequest;
use App\Http\Resources\EfetivoServidorResource;
use App\Http\Resources\EfetivoServidorCollection;

class EfetivoServidorController extends Controller
{
    public function __construct(protected EfetivoServidorService $service) {}

    public function index(EfetivoServidor $servidoresEfetivos): EfetivoServidorCollection
    {
        return new EfetivoServidorCollection($this->service->listar($servidoresEfetivos));
    }

    public function store(EfetivoServidorRequest $request): PessoaResource | array
    {
        return $this->service->inserir($request);
    }

    public function show(EfetivoServidor $servidorEfetivo): EfetivoServidorResource
    {
        return $this->service->buscar($servidorEfetivo);
    }

    public function update(EfetivoServidorRequest $request, EfetivoServidor $servidorEfetivo)
    {
       //
    }

}
