<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class EnderecoEntrega extends Model
{

    protected $table = 'tb_endereco_entrega';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'identificador',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado'
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

    //um endereco de entrega pertence a um usuario
    public function user()
    {
        return $this->belongsTo('sldb\Models\User');
    }

}
