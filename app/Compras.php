<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $fillable=[
        'comprador','produto_id','quantidade','valor','data_compra'
    ];
}
