<?php

use Illuminate\Database\Seeder;
use sldb\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado = new Estado;
        $estado->sigla = 'AC';
        $estado->descricao = 'Acre';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'AL';
        $estado->descricao = 'Alagoas';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'AP';
        $estado->descricao = 'Amapa';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'AM';
        $estado->descricao = 'Amazonas';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'BA';
        $estado->descricao = 'Bahia';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'CE';
        $estado->descricao = 'Ceará';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'DF';
        $estado->descricao = 'Distrito Federal';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'ES';
        $estado->descricao = 'Espirito Santo';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'GO';
        $estado->descricao = 'Goiás';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'MA';
        $estado->descricao = 'Maranhão';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'MT';
        $estado->descricao = 'Mato Grosso';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'MS';
        $estado->descricao = 'Mato Grosso do Sul';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'MG';
        $estado->descricao = 'Minas Gerais';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'PA';
        $estado->descricao = 'Pará';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'PB';
        $estado->descricao = 'Paraíba';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'PR';
        $estado->descricao = 'Paraná';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'PE';
        $estado->descricao = 'Pernambuco';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'PI';
        $estado->descricao = 'Piauí';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'RJ';
        $estado->descricao = 'Rio de Janeiro';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'RN';
        $estado->descricao = 'Rio Grande do Norte';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'RS';
        $estado->descricao = 'Rio Grande do Sul';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'RO';
        $estado->descricao = 'Rondônia';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'RR';
        $estado->descricao = 'Roraima';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'SC';
        $estado->descricao = 'Santa Catarina';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'SP';
        $estado->descricao = 'São Paulo';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'SE';
        $estado->descricao = 'Sergipe';
        $estado->save();

        $estado = new Estado;
        $estado->sigla = 'TO';
        $estado->descricao = 'Tocantins';
        $estado->save();
    }
}