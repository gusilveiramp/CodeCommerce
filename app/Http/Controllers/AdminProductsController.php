<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
//use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;
use CodeCommerce\Tag;
use CodeCommerce\ProductImage;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class AdminProductsController extends Controller
{
    private $model;

    public function __construct(Product $product)
    {
        //atribuo o model a variavel $product
        $this->model = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  $this->model->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category) //method injection =  o Laravel injeta o objeto automaticamente para mim.
    {
        // envio as categorias para a view products.create
        $categories = $category->lists('name', 'id');

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ProductRequest $request)
    {
        $product = $this->model->create($request->all());

        // Se a tag ja existir para esse product, ele não faz nada. Se não existir, ele adiciona a esse product e cria a relação na tabela product_tag.
        // o sync recebe o getTagsIds($request->tags), que é o private method desse controller responsável por tratar as tags e verificar se já
        // existem ou não.
        // O metodo tags() está vindo do model product.
        $product->tags()->sync($this->getTagsIds($request->tags));

        return redirect()->route('admin.products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Category $category)
    {
        // envio as categorias para a view products.create
        $categories = $category->lists('name', 'id');

        $product = $this->model->find($id);

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProductRequest $request, $id)
    {

        $request['featured'] = $request->get('featured');
        $request['recommended'] = $request->get('recommended');

        $this->model->find($id)->update($request->all());
        $product = $this->model->find($id);
        $product->tags()->sync($this->getTagsIds($request->tags));

        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->model->find($id)->delete();

        //return redirect()->route('admin.products');

        $product = $this->model->find($id);

        if($product)
        {
            if($product->images)
            {
                foreach($product->images as $image){
                    if(file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension))
                    {
                        Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
                    }
                    $image->delete();
                }
            }
            $product->delete();
            return redirect()->route('admin.products')->withSuccess('Product deleted!');
        }
        return redirect()->route('admin.products')->withError('Product not exist!');
    }

    public function images($id)
    {
        $product = $this->model->find($id);

        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->model->find($id);

        return view('products.create_image', compact('product'));
    }

    public function storeImage(Requests\ProductImageRequest $request, $id, ProductImage $productImage)
    {
        // guardo imagem do form na variável $file
        $file = $request->file('image');

        // metodo que pega a extensão original do arquivo
        $extension = $file->getClientOriginalExtension();

        // gravo no banco de dados o id do produto e a extensão através da instancia productImage 
        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        // Utilizando a Facade Storage eu insiro a imagem no disco public_local, criado por mim no arquivo config/filesystems.php.
        // nesse caso, as imagens são inseridas na pasta public/uploads
        Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

        return redirect()->route('admin.products.images', ['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        // selecione a imagem pelo id
        $image = $productImage->find($id);

        // se o arquivo existir na pasta
        if(file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension))
        {
            // Excluo a imagem da pasta utilizando o id e a extensão
            Storage::disk('public_local')->delete($image->id.'.'.$image->extension);    
        }
        
        // seleciono o product da imagem para dar o return logo abaixo
        $product = $image->product;

        // excluo a imagem do BD
        $image->delete();

        return redirect()->route('admin.products.images', ['id'=>$product->id]);

    }

    /**
     * .
     *
     * @param  array  $tags
     * @return \Illuminate\Http\Response
     */
    // Esse metodo só vai ser usado dentro do controller, por isso pode ser private.
    // Ele recebe o parametro $tags, que estão vindo do Request.
    private function getTagsIds($tags)
    {
        // array_filter remove todos os CAMPOS em branco e mantém apenas campos que possuírem dados.
        // array_map passa uma função em todos os elementos do array, no caso é o trim para remover os ESPAÇOS.
        
        // CAMPOS em branco são esaços em branco dentr de uma única TAG(espaço branco entre letras de uma tag. 
        // Ex: "   mundo ,casa, bola  ,amor, etc...

        // ESPAÇOS em branco são Tags sem nenhum caractere(espaço branco entre virgulas/tags). 
        // Ex: mundo, ,bola,casa, ,etc,...

        $tagList = array_filter(array_map('trim', explode(',', $tags)));
        $tagsIds = [];

        foreach ($tagList as $tagName) 
        {
            // $tagsIds vai receber um novo Id de uma tag.
            // utilizo o metodo firsOrCreate do Model Tag, passando o parametro name = $tagName
            // ele pesquisa no bd se exite uma tag com o nome $tagName. Se existir, ele pega a tag e o id dela e grava no array $tagsIds para 
            // depois iserir no bd. Se não existir, ele vai criar uma nova tag com o nome $tagName, pegar o id dela e gravar no array tagsIds 
            // para ser inserida no bd da mesma form.
            $tagsIds[] = Tag::firstOrCreate(['name'=> $tagName])->id;
        }

        return $tagsIds;
    }
}
