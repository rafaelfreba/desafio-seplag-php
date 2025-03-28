<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Endereco extends Model
{
    protected $table = 'enderecos';

    protected $fillable = [
        'end_tipo_logradouro',
        'end_logradouro',
        'end_numero',
        'end_bairro',
        'cidade_id',
    ];

    public function pessoas(): BelongsToMany
    {
        return $this->belongsToMany(Pessoa::class);
    }

    public function unidades(): BelongsToMany
    {
        return $this->belongsToMany(Unidade::class);
    }

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class);
    }
}
