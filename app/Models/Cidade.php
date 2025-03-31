<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'cidade';

    protected $primaryKey = 'cid_id';

    protected $fillable = [
        'cid_id',
        'cid_nome',
        'cid_uf'
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class, 'cid_id', 'cid_id');
    }
    
}
