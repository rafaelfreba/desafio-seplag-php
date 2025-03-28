<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unidade extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'unid_nome',
        'unid_sigla'
    ];

    public function enderecos(): BelongsToMany
    {
        return $this->belongsToMany(Endereco::class);
    }
}
