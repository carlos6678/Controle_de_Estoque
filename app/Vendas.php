<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $fillable=[
        'clientes_id','produtos_id','valor_venda','data_venda',
    ];
}
