<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->nullable();
            //colocar o insigned(1) como o Wesley fez deu erro na hora do migrate, por isso usei ->nullable()
            $table->foreign('category_id')->references('id')->on('categories');
            //Defino o nome da chave estrangeira(foreign) é category_id
            //Onde eu vou ter uma referencia com a minha coluna "id" da minha tabela "categories"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->removeColumn('category_id');
        });
    }
}
