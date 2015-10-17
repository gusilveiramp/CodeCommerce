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
Route::put('exemplo', 'WelcomeController@exemplo');

Route::get('category/{category}', function(\CodeCommerce\Category $category){
	return $category->name;
});
*/

Route::group(['prefix'=> 'admin', 'where'=>['id'=>'[0-9]+']], function(){

	Route::get('', ['as'=>'admin', 'uses'=>'AdminProductsController@index']);

	Route::group(['prefix'=> 'categories'], function(){

		Route::get('', ['as'=>'admin.categories', 'uses'=>'AdminCategoriesController@index']);
		Route::post('', ['as'=>'admin.categories.store', 'uses'=>'AdminCategoriesController@store']);
		Route::get('create', ['as'=>'admin.categories.create', 'uses'=>'AdminCategoriesController@create']);
		Route::get('{id}/edit', ['as'=>'admin.categories.edit', 'uses'=>'AdminCategoriesController@edit']);
		Route::put('{id}/update', ['as'=>'admin.categories.update', 'uses'=>'AdminCategoriesController@update']);
		Route::get('{id}/destroy', ['as'=>'admin.categories.destroy', 'uses'=>'AdminCategoriesController@destroy']);
	
	});

	Route::group(['prefix'=> 'products'], function(){

		Route::get('', ['as'=>'admin.products', 'uses'=>'AdminProductsController@index']);
		Route::post('', ['as'=>'admin.products.store', 'uses'=>'AdminProductsController@store']);
		Route::get('create', ['as'=>'admin.products.create', 'uses'=>'AdminProductsController@create']);
		Route::get('{id}/edit', ['as'=>'admin.products.edit', 'uses'=>'AdminProductsController@edit']);
		Route::put('{id}/update', ['as'=>'admin.products.update', 'uses'=>'AdminProductsController@update']);
		Route::get('{id}/destroy', ['as'=>'admin.products.destroy', 'uses'=>'AdminProductsController@destroy']);
		
		Route::group(['prefix'=>'images'], function(){

			Route::get('{id}/product', ['as'=>'admin.products.images', 'uses'=>'AdminProductsController@images']);
			Route::get('create/{id}/product', ['as'=>'admin.products.images.create', 'uses'=>'AdminProductsController@createImage']);
			Route::post('store/{id}/product', ['as'=>'admin.products.images.store', 'uses'=>'AdminProductsController@storeImage']);
			Route::get('destroy/{id}/product', ['as'=>'admin.products.images.destroy', 'uses'=>'AdminProductsController@destroyImage']);

		});
		
	});

});

/*Route::get('categories', ['as'=>'categories', 'uses'=>'CategoriesController@index']);
Route::post('categories', ['as'=>'categories.store', 'uses'=>'CategoriesController@store']);
Route::get('categories/create', ['as'=>'categories.create', 'uses'=>'CategoriesController@create']);
Route::get('categories/{id}/edit', ['as'=>'categories.edit', 'uses'=>'CategoriesController@edit']);
Route::put('categories/{id}/update', ['as'=>'categories.update', 'uses'=>'CategoriesController@update']);
Route::get('categories/{id}/destroy', ['as'=>'categories.destroy', 'uses'=>'CategoriesController@destroy']);*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('exemplo', 'WelcomeController@exemplo');

