<?php
use Illuminate\Database\Seeder;
use sldb\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = new Categoria;
        $categoria->descricao = 'Cachaca';
        $categoria->save();

        $categoria1 = new Categoria;
        $categoria1->descricao = 'Cerveja';
        $categoria1->save();

        $categoria2 = new Categoria;
        $categoria2->descricao = 'Destilado';
        $categoria2->save();

        $categoria3 = new Categoria;
        $categoria3->descricao = 'Gin';
        $categoria3->save();

        $categoria4 = new Categoria;
        $categoria4->descricao = 'Tequila';
        $categoria4->save();

        $categoria5 = new Categoria;
        $categoria5->descricao = 'Vinho';
        $categoria5->save();

        $categoria6 = new Categoria;
        $categoria6->descricao = 'Vodka';
        $categoria6->save();

        $categoria7 = new Categoria;
        $categoria7->descricao = 'Whisky';
        $categoria7->save();
    }
}