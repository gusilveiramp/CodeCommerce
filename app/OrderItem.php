<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
    	'product_id',
    	'price',
    	'qtd'
    ];

    //relacionamento entre items com pedido(order)
    public function order()
    {
    	// digo que esse item pertence a um pedido(order)
    	return $this->belongsTo('CodeCommerce\Order');
    }
}
