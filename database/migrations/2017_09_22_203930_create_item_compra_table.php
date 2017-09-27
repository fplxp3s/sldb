<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tb_item_compra', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('compra_id')->unsigned()->nullable(false);
            $table->string('nome_produto');
            $table->double('valor_produto', 10, 2);
            $table->integer('quantidade');
            $table->timestamps();
        });


        Schema::table('tb_item_compra', function (Blueprint $table) {

            $table->foreign('compra_id')
                ->references('id')
                ->on('tb_compra')
                ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_item_compra');
    }
}
