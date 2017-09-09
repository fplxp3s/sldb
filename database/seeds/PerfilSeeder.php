<?php

use Illuminate\Database\Seeder;
use sldb\Models\Perfil;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $perfil = new Perfil;
        $perfil->descricao = 'ADMIN';
        $perfil->save();

        $perfil2 = new Perfil;
        $perfil2->descricao = 'CLIENTE';
        $perfil2->save();

        $perfil3 = new Perfil;
        $perfil3->descricao = 'PROPRIETARIO';
        $perfil3->save();

    }
}
