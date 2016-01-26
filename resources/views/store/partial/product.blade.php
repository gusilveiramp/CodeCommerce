 @forelse($products as $product)
 <div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
            @if(count($product->images))
            <img src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}" width="200" alt="" />
            @else
                <img src="{{ url('images/no-img.jpg') }}" width="200" alt="" />
            @endif
                <h2>R$ {{ $product->price }}</h2>
                <p><strong>{{ $product->name }}</strong></p>
                <a href="{{ route('store.product', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>Mais detalhes</a>
                <!--<a href="{{ route('cart.add', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar no carrinho</a>-->
            </div>
            <div class="product-overlay">
                <div class="overlay-content">
                    <h2>R$ {{ $product->price }}</h2>
                    <p>{{ $product->name }}</p>
                    <a href="{{ route('store.product', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>Mais detalhes</a>
                    
                    <!-- 
                        PROFESSOR, COMO ESTOU TRABALHANDO COM CORES NO CART, EU REMOVI O BOTÃO DA HOMEPAGE.
                        CASO CONTRÁRIO, EU PRECISARIA DAR AO USUÁRIO A OPÇÃO DE SELECIONAR A COR NA HOMEPAGE
                        O QUE NÃO TEM NECESSIDADE NESTE MOMENTO.
                    -->

                    <!--<a href="{{ route('cart.add', ['id'=>$product->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar no carrinho</a>-->

                </div>
            </div>
        </div>
    </div>
</div>
@empty
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
            <h3>Sorry, nothing found...</h3>
            </div>
        </div>
    </div>
@endforelse