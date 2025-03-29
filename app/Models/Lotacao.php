<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lotacao extends Model
{
    protected $table = 'lotacoes';

    protected $fillable = [
        'pessoa_id',
        'unidade_id',
        'lot_data_lotacao',
        'lot_data_remocao',
        'lot_portaria'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }
}
