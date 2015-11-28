<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Category;
use CodeCommerce\Tag;

class TagController extends Controller
{

    private $categoryModel;
    private $tagModel;

    public function __construct(Category $category, Tag $tag)
    {
        $this->categoryModel = $category;
        $this->tagModel = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // seleciono todas as categorias do bd    
        $categories = $this->categoryModel->all();

        // seleciono a tag pelo id para envia-lo a view.
        // (lá no model Tag.php) como eu fiz o belongsToMany, 'product_tag', relacionando com a tabela 'product_tag',
        // eu só preciso enviar as tags para a view e lá na view informar: foreach($tag->products as $product)
        // assim temos os todos os produtos relacionados a essa tag.
        $tag = $this->tagModel->find($id);

        return view('store.tag', compact('categories', 'tag'));
    }
}
