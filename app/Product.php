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

    // Este metodo tráz as tags relacionadas ao produto em questão.
    public function tags()
    {
        // digo que minhas tags dentro desse meu produto podem pertencer a outras tags e outros produtos também podem ter essas tags.
        // por isso utilizamos belongsToMany.
        // 'product_tag' é a tabela que está fazendo os relacionamentos.
        return $this->belongsToMany('CodeCommerce\Tag', 'product_tag');
    }

    // Este método exibe as tags vindas do bd na view edit.blade.php e create.blade.php.
    // getTagListAttribute é um atributo dinamico, portanto as palavras get e Attribute são obrigatórias no nome da função.
    // e o nome que vai entre elas (TagList, nesse caso), é o nome do nosso atributo dinâmico.
    public function getTagListAttribute()
    {
        // crio uma lista dos nomes de tags e mando trazer todos em array pelo all();
        $tags = $this->tags()->lists('name')->all();
        // retorno as tags separadas por uma virgula e um espaço.
        return implode(', ', $tags);
    }

    public function scopeFeatured($query)
    {   
        // pego os produtos da coluna featured que possuirem valor 1
        return $query->where('featured','=',1);
    }

    public function scopeRecommended($query)
    {   
        // pego os produtos da coluna featured que possuirem valor 1
        return $query->where('recommended','=',1);
    }

    // no scopeOf nós podemos passar argumentos ($type) como parametros na função.
    public function scopeOfCategory($query, $type)
    {
        return $query->where('category_id','=', $type);
    }
}
