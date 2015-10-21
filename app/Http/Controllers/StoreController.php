<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

use CodeCommerce\Category;
use CodeCommerce\Product;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // acesso o metodo scoopFeatured do model e tráz do BD os produtos marcados com valor 1 no campo featured
        $pFeatured = Product::featured()->get();

        // acesso o metodo scoopRecommended do model e tráz do BD os produtos marcados com valor 1 no campo Recommended
        $pRecommended = Product::recommended()->get();

        $categories = Category::all();

        return view('store.index', compact('categories', 'pFeatured', 'pRecommended'));
    }

    // exibe categorias de produtos
    public function category($id)
    {
        $categories = Category::all();

        $category = Category::find($id);

        // digo que quero pegar o produto da categoria $id
        $products = Product::ofCategory($id)->get();

        return view('store.category', compact('categories','category','products'));
    }

    public function product($id)
    {
        $categories = Category::all();

        $product = Product::find($id);

        return view('store.product', compact('categories','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
