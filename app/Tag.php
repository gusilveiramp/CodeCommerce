<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

    public function products()
    {
    	// Esta tag pertence a muitos produtos.
    	// Este metodo tráz os produtos relacionados a tag em questão.
    	// 'product_tag' é a tabela que está fazendo os relacionamentos.
    	return $this->belongsToMany('CodeCommerce\Product', 'product_tag');
    }
}