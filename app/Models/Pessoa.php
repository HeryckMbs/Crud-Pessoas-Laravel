<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome','cpf','endereco'];
    /**
     * Relacionamento para buscar os telefones de um usuário
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'pessoa_id', );
    }
}
