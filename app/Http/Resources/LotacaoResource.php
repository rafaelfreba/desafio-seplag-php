<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LotacaoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'lot_id' => $this->lot_id,
            'pes_nome'=> $this->pessoa->pes_nome,
            'lot_data_lotacao'=> $this->lot_data_lotacao,
            'lot_data_remocao'=> $this->lot_data_remocao ?? null,
            'lot_portaria'=> $this->lot_portaria
        ];
    }
}
