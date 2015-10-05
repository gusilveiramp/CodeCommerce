<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::group(['prefix'=> 'admin'], function(){

	Route::get('products', function(){
		return "Products";
	});

});

Route::get('/exemplo2', function(){
	return "Oi";
});

Route::post('/exemplo2', function(){
	return "Oi";
});

Route::match(['get','post'], '/exemplo2', function(){
	return "oi";
});

Route::any('/exemplo2', function(){
	return "oi";
});

Route::get('produtos', ['as'=>'produtos', function(){
	echo Route::currentRouteName();
	//return "Produtos";
}]);

Route::pattern('id','[0-9]+');

Route::get('user/{id?}', function($id = 123){
	if($id)
		return "Olá, o ID é: ".$id;
	return "Não possui ID";
})->where('id','[A-Za-z0-9]+');

Route::put('exemplo', 'WelcomeController@exemplo');

Route::get('category/{category}', function(\CodeCommerce\Category $category){
	return $category->name;
});
*/
Route::get('admin/categories', ['as'=>'admin.categories', 'uses'=>'AdminCategoriesController@index']);
Route::get('admin/products', ['as'=>'admin.products', 'uses'=>'AdminProductsController@index']);

Route::get('categories', ['as'=>'categories', 'uses'=>'CategoriesController@index']);
Route::post('categories', ['as'=>'categories.store', 'uses'=>'CategoriesController@store']);
Route::get('categories/create', ['as'=>'categories.create', 'uses'=>'CategoriesController@create']);
Route::get('categories/{id}/edit', ['as'=>'categories.edit', 'uses'=>'CategoriesController@edit']);
Route::put('categories/{id}/update', ['as'=>'categories.update', 'uses'=>'CategoriesController@update']);
Route::get('categories/{id}/destroy', ['as'=>'categories.destroy', 'uses'=>'CategoriesController@destroy']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('exemplo', 'WelcomeController@exemplo');

