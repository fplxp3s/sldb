<?php

namespace sldb\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'perfil_id',
    ];

    public $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    //protected $dateFormat = 'd-m-Y H:i:s'; //mysql nao permite esse formato

    /**
     * mapeamento do relacionamento do usuario com seu perfil
     * o usuario pode possuir apenas um perfil no sistema
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function perfil()
    {
        return $this->hasOne('sldb\Models\Perfil');
    }
}
