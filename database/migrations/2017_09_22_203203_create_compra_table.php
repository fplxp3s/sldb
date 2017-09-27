<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('tb_compra', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(false);
            $table->integer('endereco_entrega_id')->unsigned()->nullable(false);
            $table->double('valor_total', 10, 2);
            $table->double('valor_subtotal', 10, 2);
            $table->string('forma_pagto');
            $table->double('valor_frete', 10, 2);
            $table->string('data');
            $table->timestamps();
        });


        Schema::table('tb_compra', function (Blueprint $table) {

            $table->foreign('user_id')
                ->references('id')
                ->on('tb_usuario')
                ->onDelete('cascade');

        });

        Schema::table('tb_compra', function (Blueprint $table) {

            $table->foreign('endereco_entrega_id')
                ->references('id')
                ->on('tb_endereco_entrega')
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
        Schema::dropIfExists('tb_compra');
    }
}
