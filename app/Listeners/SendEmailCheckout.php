<?php

namespace CodeCommerce\Listeners;


use Mail;
use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

// SendEmailCheckout é uma classe que possui o metodo "handle", que recebe o nosso evento.
class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */

    // handle recebe o nosso evento CheckoutEvent.
    public function handle(CheckoutEvent $event)
    {
        // $event->getUser() pega o user que eu passei para o meu evento
        // o user foi passado ao CheckoutEvent através do CheckoutController, 
        // no momento em que eu usei o event() no CheckoutController
        $user = $event->getUser();
        $order = $event->getOrder();

        // atribui a $orderItems[] os nomes dos produtos da order
        foreach($order->items as $item){ 
            $orderItems[] = $item->product->name;
        }

        // separo os items do $orderItems por virgulas e atribuo eles a variavel $items
        $items = implode(', ', $orderItems);

        $data = [
            'user'=>$user,
            'order'=>$order,
            'items'=>$items,
            'email'=>'noreply@codecommerce.com'
        ];

        Mail::send('emails.checkout', $data, function($message) use ($data){
            $message->to('gdsmp@hotmail.com', 'CodeCommerce')
              ->subject('Order Details: '.$data['items'] )
              ->replyTo($data['email']);
        });
    }
}
