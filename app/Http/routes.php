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

Route::get('/', function () {
    return view('welcome');
});
*/

// Route::controllers significa que ele vai ler os controllers em questão e vai pegar todos os metodos deste
// controller e torna-los acessíveis. 
Route::controllers([
	'auth'=>'Auth\AuthController',
	'password'=>'Auth\PasswordController',
]);

Route::group(['prefix'=> 'admin', 'middleware'=>'auth', 'where'=>['id'=>'[0-9]+']], function(){

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

Route::get('/', 'StoreController@index');
Route::get('home', 'StoreController@index');
Route::get('category/{id}', ['as'=>'store.category', 'uses'=>'StoreController@category']);
Route::get('product/{id}', ['as'=>'store.product', 'uses'=>'StoreController@product']);
Route::get('tag/{id}', ['as'=>'store.tag', 'uses'=>'TagController@index']);
Route::get('cart', ['as'=>'cart', 'uses'=>'CartController@index']);
Route::get('cart/add/{id}', ['as'=>'cart.add', 'uses'=>'CartController@add']);
Route::get('cart/remove/{id}', ['as'=>'cart.remove', 'uses'=>'CartController@remove']);
Route::get('cart/destroy/{id}', ['as'=>'cart.destroy', 'uses'=>'CartController@destroy']);

//Precisa estar autenticado para acessar
Route::group(['middleware'=>'auth'], function(){
	Route::get('checkout/placeOrder', ['as'=>'checkout.place', 'uses'=>'CheckoutController@place']);
	Route::get('account/orders', ['as'=>'account.orders', 'uses'=>'AccountController@orders']);
});

Route::get('test', 'CheckoutController@test');

/*
Route::get('evento', function(){
	// Disparo o evento CheckoutEvent()
	// Sempre que eu chamar o helper event() todos os listeners do evento serão disparados.
    // o metodo que dispara os listeners é o Event::fire(), porém podemos usar apenas event() que dá na mesma.
	Event(new \CodeCommerce\Events\CheckoutEvent());
});
*/


