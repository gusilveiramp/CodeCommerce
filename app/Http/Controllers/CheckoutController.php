<?php

namespace CodeCommerce\Http\Controllers;

use Auth;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use CodeCommerce\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function place(Order $orderModel, OrderItem $orderItem)
    {
        // se não existir carrinho na sessão
        if (!Session::has('cart')) {
            // retorna false
            return false;
        }

        // pega os valores gravados na sessão cart
        $cart = Session::get('cart');

        //carrego as categries para exibir na coluna lateral
        $categories = Category::all();

        // se o total de items for maior que 0
        if($cart->getTotal() > 0) {
            // cria o pedido passando um array com os items
            // Auth::user()->id pega o id od usuário logado
            $order = $orderModel->create(['user_id'=> Auth::user()->id, 'total'=>$cart->getTotal()]);

            // adiciona todos os items dentro da nossa ordem
            foreach ($cart->all() as $k=>$item) {
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
            }

            // chamo o metodo clear do model Cart.php para limpar o cart.
            // caso contrário, ele iria criar um novo pedido a cada refresh da página.
            $cart->clear();

            // dispara o evento passando para o CheckoutEvent os dados do User e do Order
            Event(new \CodeCommerce\Events\CheckoutEvent(Auth::user(), $order));

            // retorno a view checkout com a order e as categories
            return view('store.checkout', ['order'=>$order, 'categories'=>$categories]);
        }
        // retorno a view checkou com as categories
        return view('store.checkout', ['categories'=>$categories]);
    }
}
