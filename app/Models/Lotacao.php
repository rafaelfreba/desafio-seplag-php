<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lotacao extends Model
{
    protected $table = 'lotacao';

    protected $primaryKey = 'lot_id';

    protected $fillable = [
        'lot_id',
        'pes_id',
        'unid_id',
        'lot_data_lotacao',
        'lot_data_remocao',
        'lot_portaria'
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class, 'pes_id', 'pes_id');
    }

    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class, 'unid_id', 'unid_id');
    }
}
