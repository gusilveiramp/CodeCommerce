<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category_id',
    	'name', 
    	'description', 
    	'price', 
    	'featured', 
    	'recommended',
    ];

    public function images()
    {
        // digo que o produto tem muitas imagens. Associação entre produto e imagens.
        return $this->hasMany('CodeCommerce\ProductImage');
    }

    public function category()
    {
    	// digo que o produto pertence a uma categora. Associação entre produto e categorias.
    	return $this->belongsTo('CodeCommerce\Category');
    }

    public function tags()
    {
        // digo que minhas tags dentro desse meu produto podem pertencer a outras tags e outros produtos também podem ter essas tags.
        // por isso utilizamos belongsToMany.
        return $this->belongsToMany('CodeCommerce\Tag');
    }

    public function getTagListAttribute()
    {
        //seleciono a tag pelo nome usando o lists, onde ele retorna uma lista do que nós queremos.
        $tags = $this->tags->lists('name');

        // retorno as tags separando-as por virgula
        return implode(',', $tags);
    }
}
