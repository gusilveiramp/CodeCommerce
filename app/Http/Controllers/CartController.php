<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
//use CodeCommerce\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{   
    /**
     * @param Cart $cart
     */
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('cart')) {
            //set('cart') recebe $this->cart
            Session::set('cart', $this->cart);
        }
        // pego o conteúdo que está na sessão e passo para a view
        return view('store.cart', ['cart' => Session::get('cart')]);
    }

    /**
     * Add Items to Cart.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {   
        // trago o metodo
        $cart = $this->getCart();

        // Importo e pego o meu produto
        $product = Product::find($id);
        // adiciono o produto ao carrinho
        $cart->add($id, $product->name, $product->price);

        // adiciono o carrinho alterado/final a minha sessão
        Session::set('cart', $cart);

        return redirect()->route('cart');
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // pego o cart
        $cart = $this->getCart();
        // chamo a função remove do model para remover o item utilizando o id
        $cart->remove($id);
        // seto novamente a sessão 'cart' com os valores de $cart (agora com o item removido)
        Session::set('cart', $cart);

        return redirect()->route('cart');
    }

    /**
     * @return Cart
     */
    private function getCart()
    {
        // se tiver uma sessão do cart
        if(Session::has('cart')){
            // pegamos o cart da nossa sessão
            $cart = Session::get('cart');
        } else {
            // se não pegamos o cart do model
            $cart = $this->cart;
        }
        // retorno o resultado
        return $cart;
    }
}
