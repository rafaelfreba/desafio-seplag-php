<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EfetivoServidor extends Model
{
    protected $table = 'efetivos_servidores';

    protected $fillable = [
        'pessoa_id',
        'se_matricula',
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id');
    }
}
