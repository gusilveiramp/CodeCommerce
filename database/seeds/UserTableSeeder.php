<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use CodeCommerce\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users');
        
        // cria um usuário específico.
        factory('CodeCommerce\User')->create(
        	[
        		'name' => 'Gustavo',
                'email' => 'admin@admin.com',
                'password' => bcrypt(123123),
                'remember_token' => str_random(10),
        	]
        );
        
        factory('CodeCommerce\User', 3)->create();
    }
}
