<?php

namespace CodeCommerce\Http\Controllers;

use Auth;

use CodeCommerce\Category;
//use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller; //Apagar depois...Não está sendo usada
use CodeCommerce\Order;
use CodeCommerce\OrderItem;

use Illuminate\Http\Request; //Apagar depois...Não está sendo usada
use Illuminate\Support\Facades\Session;

// Não esqueça de carregar as classes que irá usar
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Production;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Customer\Phone;
use PHPSC\PagSeguro\Customer\Address;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use PHPSC\PagSeguro\Shipping\Shipping;
use PHPSC\PagSeguro\Shipping\Type;

use Correios;
use Illuminate\Support\Facades\Response; //Retorna o json...

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
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, ".", ""), $item['qtd'], number_format(20, 2, ".", ""), 10));
                // insere no bd os items do cart
                $order->items()->create(['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']]);
            }
            $Phone = new Phone(11, 999999999);
            $Address = new Address(
                'SP', 
                'Indaiatuba', 
                '13330120', 
                'Centro', 
                '13 de Maio', 
                '110', 
                'Apto. 45B'
            );
            //$Credentials = new Credentials('gdsmp1@gmail.com', 'FE12A9050B864656A57AD8A315651DAE', 'sandbox');
            $checkout->setCustomer(new Customer("c15047267204184693516@sandbox.pagseguro.com.br", "Nome do Cliente", $Phone, $Address))
                     ->setShipping(new Shipping(1, $Address, number_format(10, 2, ".", "")));

            // chamo o metodo clear do model Cart.php para limpar o cart.
            // caso contrário, ele iria criar um novo pedido a cada refresh da página.
            $cart->clear();

            // dispara o evento passando para o CheckoutEvent os dados do User e do Order
            Event(new \CodeCommerce\Events\CheckoutEvent(Auth::user(), $order));

            // atribui a variavel $response os valores do builder, finalizando o checkout do pagseguro
            $response = $checkoutService->checkout($checkout->getCheckout());

            // redireciono para a tela de pagamento do pagseguro, passando o $response que contém os dados para o checkout
            return redirect($response->getRedirectionUrl());
            // retorno a view checkout com a order e as categories
            //return view('store.checkout', ['order'=>$order, 'categories'=>$categories]);
        }
        // retorno a view checkou com as categories
        return view('store.checkout', ['categories'=>$categories]);
    }

    public function getFretes($cep)  
    {   
        
        $pac = [
            'tipo'              => 'pac', // opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '89062080', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => '1', // Peso em kilos
            'comprimento'       => '16', // Em centímetros
            'altura'            => '11', // Em centímetros
            'largura'           => '11', // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];
        $sedex = [
            'tipo'              => 'sedex', // opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '89062080', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => '1', // Peso em kilos
            'comprimento'       => '16', // Em centímetros
            'altura'            => '11', // Em centímetros
            'largura'           => '11', // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];
        $sedex_10 = [
            'tipo'              => 'sedex_10', // opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '89062080', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => '1', // Peso em kilos
            'comprimento'       => '16', // Em centímetros
            'altura'            => '11', // Em centímetros
            'largura'           => '11', // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];
        $sedex_hoje = [
            'tipo'              => 'sedex_hoje', // opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '89062080', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => '1', // Peso em kilos
            'comprimento'       => '16', // Em centímetros
            'altura'            => '11', // Em centímetros
            'largura'           => '11', // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];

        $fretePac = Correios::frete($pac);
        $freteSedex = Correios::frete($sedex);
        $freteSedex10 = Correios::frete($sedex_10);
        $freteSedexHoje = Correios::frete($sedex_hoje);

        $dados = [
            'pac' => $fretePac,
            'sedex' => $freteSedex,
            'sedex10' => $freteSedex10,
            'sedexhoje' => $freteSedexHoje
        ];

        return Response::json($dados);
    }
}
