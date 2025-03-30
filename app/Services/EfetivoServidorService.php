<?php

namespace App\Services;

use App\Models\EfetivoServidor;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EfetivoServidorService
{
    public function listar($unidadeId)
    {
        $query = EfetivoServidor::withRelations();

        if (isset($unidadeId)) {
            $query->whereHas('pessoa.lotacoes', function ($query) use ($unidadeId) {
                $query->where('unidade_id', $unidadeId);
            });
        }

        $servidores = $query->paginate(5);

        if ($servidores->isEmpty()) {
            throw new ModelNotFoundException('Servidores efetivos não encontrados.');
        }

        return $servidores;
    }

    public function buscar(int $servidorId): EfetivoServidor
    {
        $servidor = EfetivoServidor::find($servidorId);

        if (!$servidor) {
            throw new ModelNotFoundException('Servidor efetivo não encontrado.');
        }

        return $servidor;
    }
}
