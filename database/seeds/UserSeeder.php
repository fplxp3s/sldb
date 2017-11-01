<?php

use Illuminate\Database\Seeder;
use sldb\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Vitor Marques';
        $user->email = 'vitormarques.sa@gmail.com';
        $user->cpf = '111.328.217-70';
        $user->data_nascimento = '1988-03-09';
        $user->telefone = '(21)969236537';
        $user->password = bcrypt('admin');
        $user->perfil_id = 1; //ADMIN
        $user->save();
    }
}
