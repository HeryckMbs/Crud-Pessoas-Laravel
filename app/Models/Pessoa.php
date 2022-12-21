<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['nome','cpf'];

    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'pessoa_id', );
    }
}
