<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServidorTemporario extends Model
{
    protected $table = 'servidores_temporarios';

    protected $fillable = [
        'pessoa_id',
        'st_data_admissao',
        'st_data_demissao'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }
}
