<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
    	'product_id',
    	'order_id',
    	'price',
    	'qtd'
    ];

    public function order()
    {
    	// Relacionamento entre Items e Order.
    	// Digo que esses produtos pertencem a uma ordem específica.
    	return $this->belongsTo('CodeCommerce\Order');
    }

    public function product()
    {
        // Relacionamento entre Items e Products.
        return $this->belongsTo('CodeCommerce\Product');
    }
}
