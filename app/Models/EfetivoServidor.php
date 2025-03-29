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
        return $this->belongsTo(Pessoa::class);
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
