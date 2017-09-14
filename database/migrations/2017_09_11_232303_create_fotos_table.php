<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_foto', function(Blueprint $table)
        {
            $table->increments('id')->unsigned()->nullable(false);
            /*$table->integer('produto_id')->unsigned()->nullable(false);*/
            $table->string('nome_arquivo', 255)->nullable(false);
            $table->timestamps();
        });

/*        Schema::table('tb_foto', function (Blueprint $table) {

            $table->foreign('produto_id')
                ->references('id')
                ->on('tb_produto')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_foto');
    }
}
