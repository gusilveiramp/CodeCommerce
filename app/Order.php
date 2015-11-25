<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public function items()
    {
    	//Com isso eu acesso todos os items referentes a essa ordem.
    	return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function user()
    {
    	//Relacionamento entre usuário e ordem
    	//Com isso sou capaz de recuperar o usuário relacionado a uma ordem específica
    	return $this->belongsTo('CodeCommerce\User');
    }
}
