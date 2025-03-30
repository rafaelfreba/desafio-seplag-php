<?php

namespace App\Services;

use App\Models\ServidorTemporario;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServidorTemporarioService
{
    public function listar($unidadeId)
    {
        $query = ServidorTemporario::withRelations();

        if ($unidadeId) {
            $query->whereHas('pessoa.lotacoes', function ($query) use ($unidadeId) {
                $query->where('unidade_id', $unidadeId);
            });
        }

        $servidores = $query->paginate(5);

        if ($servidores->isEmpty()) {
            throw new ModelNotFoundException('Servidores temporarios não encontrados.');
        }

        return$servidores;
    }

    public function buscar(int $servidorId): ServidorTemporario
    {
        $servidor = ServidorTemporario::find($servidorId);

        if (!$servidor) {
            throw new ModelNotFoundException('Servidor temporário não encontrado.');
        }

        return $servidor;
    }
}