<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_Color', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('Color_id')->unsigned();
            $table->foreign('Color_id')->references('id')->on('Colors')->onDelete('cascade');
            // É importante utilizarmos onDelete->cascade pois este comando faz com que o 
            // dado seja apagado de todas as tabelas com as quais ele esteja relacionado.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_Color');
    }
}
