<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pessoa extends Model
{
    protected $table = 'pessoas';

    protected $fillable = [
        'pes_nome',
        'pes_data_nascimento',
        'pes_sexo',
        'pes_mae',
        'pes_pai',
        
    ];

    public function fotoPessoa(): HasOne
    {
        return $this->hasOne(FotoPessoa::class);
    }

    public function enderecos(): BelongsToMany
    {
        return $this->belongsToMany(Endereco::class);
    }

    public function servidorTemporario(): HasOne
    {
        return $this->hasOne(ServidorTemporario::class);
    }

    public function servidorEfetivo(): HasOne
    {
        return $this->hasOne(EfetivoServidor::class);
    }
}
