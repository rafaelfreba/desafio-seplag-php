<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServidorEfetivo extends Model
{
    protected $table = 'servidor_efetivo';

    protected $fillable = [
        'pes_id',
        'se_matricula',
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class ,'pes_id', 'pes_id');
    }

    public function lotacao()
    {
        return $this->hasOne(Lotacao::class, 'pes_id', 'pes_id');
    }

    public function scopeWithRelations()
    {
        return self::with([
            'pessoa',
            'pessoa.enderecos',
            'pessoa.enderecos.cidade',
            'pessoa.lotacoes',
            'pessoa.lotacoes.unidade',
            'pessoa.fotos']);
    }
}
