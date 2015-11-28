<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller; //Apagar depois...Não está sendo usada
use CodeCommerce\Order;
use CodeCommerce\OrderItem;

use Illuminate\Http\Request; //Apagar depois...Não está sendo usada
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    public function place(Order $orderModel, OrderItem $orderItem, CheckoutService $checkoutService)
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

            // atribui a variavel $checkout o builder da API do pagseguro
            $checkout = $checkoutService->createCheckoutBuilder();

            // cria o pedido passando um array com os items
            // Auth::user()->id pega o id od usuário logado
            $order = $orderModel->create(['user_id'=> Auth::user()->id, 'total'=>$cart->getTotal()]);

            // adiciona todos os items dentro da nossa ordem
            foreach ($cart->all() as $k=>$item) {
                // adiciona os items do cart ao builder do pagseguro
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, ".", ""), $item['qtd']));
                // insere no bd os items do cart
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
            }

            // chamo o metodo clear do model Cart.php para limpar o cart.
            // caso contrário, ele iria criar um novo pedido a cada refresh da página.
            $cart->clear();

            // dispara o evento passando para o CheckoutEvent os dados do User e do Order
            event(new CheckoutEvent(Auth::user(), $order));

            // atrbui a variavel $response os valores do builder, finalizando o checkout do pagseguro
            $response = $checkoutService->checkout($checkout->getCheckout());

            // redireciono para a tela de pagamento do pagseguro, passando o $response que contém os dados para o checkout
            return redirect($response->getRedirectionUrl());
            // retorno a view checkout com a order e as categories
            //return view('store.checkout', ['order'=>$order, 'categories'=>$categories]);
        }
        // retorno a view checkou com as categories
        return view('store.checkout', ['categories'=>$categories]);
    }

    public function test(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());
    }
}
