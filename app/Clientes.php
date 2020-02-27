<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{   
    public $timestamps=false;
    
    protected $fillable=[
        'cep','razao_social','cnpj','estado','municipio','telefone','bairro','rua','numero'
    ];
}
