<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{

    protected $table = 'tb_item_compra';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'compra_id',
        'nome_produto',
        'valor_produto',
        'quantidade'
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

    //um item pertence a uma compra
    public function compra()
    {
        return $this->belongsTo('sldb\Models\Compra');
    }

}
