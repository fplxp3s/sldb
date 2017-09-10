<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'tb_categoria';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
    ];

    public $guarded = ['id'];

    public $timestamps = false;

    //uma categoria pode possuir varios produtos associados a ela
    public function produtos()
    {
        return $this->hasMany('sldb\Models\Produto');
    }

}
