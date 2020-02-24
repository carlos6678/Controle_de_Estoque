<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricantes extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'nome','email','cnpj/cpf','estado','municipio','telefone','bairro','rua','numero'
    ];

}
