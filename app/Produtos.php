<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    public $timestamps=false;

    protected $fillable=[
        'nome','cod','fabricante_id','representante','quantidade','valor_venda','valor_compra','data_fabricaçao','data_vencimento'
    ];
}
 