<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope('security_agenda', function (Builder $builder) {
            //pegar apenas contatos do usuário logado
            $builder->where('user_id', auth()->user()->id);
        });
    }
}
