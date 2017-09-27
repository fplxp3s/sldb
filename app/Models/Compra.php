<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'tb_compra';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'endereco_entrega_id',
        'valor_total',
        'valor_subtotal',
        'valor_frete',
        'forma_pagto',
        'data'
    ];

    public $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    //uma compra pertence a um usuario
    public function user()
    {
        return $this->belongsTo('sldb\Models\User');
    }

    //uma compra tem um endereco de entrega
    public function enderecoEntrega()
    {
        return $this->belongsTo('sldb\Models\EnderecoEntrega');
    }

    //uma compra pode ter varios itens
    public function itensCompra()
    {
        return $this->hasMany('sldb\Models\ItemCompra');
    }

}
