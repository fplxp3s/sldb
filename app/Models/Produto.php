<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{

    protected $table = 'tb_produto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'loja_id',
        'categoria_id',
        'nome',
        'descricao',
        'preco',
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

    //um produto pertence a uma loja
    public function loja()
    {
        return $this->belongsTo('sldb\Models\Loja');
    }

    //um produto pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo('sldb\Models\Categoria');
    }
}
