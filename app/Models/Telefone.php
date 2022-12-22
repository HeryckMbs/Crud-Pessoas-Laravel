<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;
    protected $fillable = ['telefone',
    'descricao',
    ];

    /**
     * Relacionamento para buscar o dono do telefone
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dono()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
}
