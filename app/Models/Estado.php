<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

    protected $table = 'tb_estado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sigla', 'descricao'
    ];

    public $guarded = ['id'];

    public $timestamps = false;

}
