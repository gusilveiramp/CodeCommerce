<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\ProductColor;

class ProductColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_color');//Trucante limpa a tabela de categorias

        factory('CodeCommerce\ProductColor', 1)->create();
    }
}
