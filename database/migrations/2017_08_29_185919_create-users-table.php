<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned()->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false)->unique();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('tb_usuario', function(Blueprint $table) {
            $table->foreign('perfil_id')
                ->references('id')
                ->on('tb_perfil');
        });

        Schema::table('tb_usuario', function(Blueprint $table) {
            $table->string('cpf')->after('email');
            $table->string('telefone')->after('cpf');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_usuario');
    }
}
