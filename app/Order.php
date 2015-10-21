<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

	// relacionamento entre items e order
    public function items()
    {
    	// Com isso consigo acessar todos os items dessa order.
    	return $this->hasMany('CodeCommerce\OrderItem');
    }

    // relacionamento entre Order e Usuario
    public function user()
    {
    	return $this->belongsTo('CodeCommerce\User');
    }
}
