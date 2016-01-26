<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Cart;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use Illuminate\Http\Request;
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
    public function add(Request $request, $id)
    {   
        // trago o metodo
        $cart = $this->getCart();

        // Importo e pego o meu produto
        $product = Product::find($id);

        // pego a cor
        $color = $request->get('color');

        // verifico se a cor é formato HEX
        if (preg_match('/^#[a-f0-9]{6}$/i', $color)) {
            // adiciono o produto ao carrinho
            $cart->add($id, $product->name, $product->price, $color);

            // adiciono o carrinho alterado/final a minha sessão
            Session::set('cart', $cart);
        } else {
            return redirect()->route('store.product', ['id'=>$id])->withError('Por favor, selecione uma Cor para o produto!');
        }

        return redirect()->route('cart');
    }

    public function remove($id){

        $cart = $this->getCart();

        $qtd = $cart->getQtd($id);

        if($qtd > 1){

            $cart->removeItem($id);

            Session::set('cart', $cart);

            return redirect()->route('cart');

        } else {

            return redirect()->route('cart');
        }
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
