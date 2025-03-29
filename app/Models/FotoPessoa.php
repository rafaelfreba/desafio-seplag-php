<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FotoPessoa extends Model
{
    protected $table = 'foto_pessoa';

    protected $fillable = [
        'pessoa_id',
        'fp_data',
        'fp_bucket',
        'fp_hash'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }
}
