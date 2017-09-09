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
        $user->password = bcrypt('admin');
        $user->perfil_id = 1; //ADMIN
        $user->save();
    }
}
