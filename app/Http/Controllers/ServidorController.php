<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EfetivoServidor;
use App\Services\ServidorService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ServidorRequest;
use App\Http\Resources\PessoaResource;
use App\Http\Resources\ServidorResource;
use App\Services\EfetivoServidorService;
use App\Services\ServidorTemporarioService;

class ServidorController extends Controller
{
    public function __construct(
        protected ServidorService $service,
        protected EfetivoServidorService $efetivoServidorService,
        protected ServidorTemporarioService $servidorTemporarioService,
    ) {}

    public function index(Request $request)
    {
        $unidadeId = $request->query('unid_id') ?? null;

        $routeName = request()->route()->getName();

        return $this->service->listar($routeName, $unidadeId);
    }

    public function store(ServidorRequest $request): PessoaResource | array
    {
        return $this->service->inserir($request);
    }

    public function show(int $servidorId): ServidorResource | JsonResponse
    {
        $routeName = request()->route()->getName();

        return $this->service->buscar($routeName, $servidorId);
    }

    public function update(ServidorRequest $request, int $id)
    {
        if($request->safe()->se_matricula){
           return  $this->efetivoServidorService->atualizar($request, $id);
            // return new ServidorPorUnidadeCollection($servidores);
        }
        
    }

}
