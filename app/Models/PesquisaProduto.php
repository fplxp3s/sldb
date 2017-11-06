<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class PesquisaProduto extends Model
{
    protected $table = 'tb_pesquisa_produto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['texto'];

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
    protected $dates = ['created_at', 'updated_at'];

}
