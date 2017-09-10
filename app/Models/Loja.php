<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{

    protected $table = 'tb_loja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'razao_social',
        'nome_fantasia',
        'nome_representante',
        'cpf_representante',
        'cnpj',
        'cidade',
        'estado',
        'bairro',
        'endereco',
        'telefone',
        'telefone2',
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

    //uma loja pertence a um usuario
    public function user()
    {
        return $this->belongsTo('sldb\Models\User');
    }

    //uma loja pode ter varios produtos
    public function produtos()
    {
        return $this->hasMany('sldb\Models\Produto');
    }

}
