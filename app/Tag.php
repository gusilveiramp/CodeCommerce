<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];

    public function products()
    {
    	// Este metodo tráz os produtos relacionados a tag em questão.
    	// 'posts_tags' é a tabela que está fazendo os relacionamentos.
    	return $this->belongsToMany('CodeCommerce\Product', 'product_tag');
    }
}