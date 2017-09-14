<?php

namespace sldb\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{

    protected $table = 'tb_foto';

    protected $fillable = ['nome_arquivo'];

    public function produto()
    {
        return $this->hasOne('sldb\Models\Produto');
    }

}
