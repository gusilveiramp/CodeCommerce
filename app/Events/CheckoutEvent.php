<?php

namespace CodeCommerce\Events;

use CodeCommerce\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckoutEvent extends Event
{
    use SerializesModels;
    private $user;
    private $order;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $order)
    {
        // crio as variáveis para receberem os dados do CheckoutController.php
        // nesse momento eu estou recebendo o user e o order que estão vindo do CheckoutController.php
        $this->user = $user;
        $this->order = $order;
    }

    // crio o getter para poder utilizar os dados do user no Listener SendEmailCheckout.php
    public function getUser()
    {
        return $this->user;
    }

    // crio o getter para poder utilizar os dados da order no Listener SendEmailCheckout.php
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
