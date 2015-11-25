<?php

namespace CodeCommerce\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //CheckoutEvent é o meu evento, que foi criado na pasta Events
        'CodeCommerce\Events\CheckoutEvent' => [
            //SendEmailCheckout é o Listener pertencente ao evento acima, que é o CheckoutEvent()
            // um evento pode ter mais de um listener. No caso temos apenas 1.
            // Sempre que eu chamar o helper event() todos os listeners do evento serão disparados.
            // o metodo que dispara os listeners é o Event::fire(), porém podemos usar apenas event() que dá na mesma.
            'CodeCommerce\Listeners\SendEmailCheckout',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
