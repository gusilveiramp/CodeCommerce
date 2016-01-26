@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@section('styles')
<style>
    .btn i.fa {               
    opacity: 0;             
    }
    .btn.active i.fa {                
        opacity: 1;             
    }
</style>
@endsection

@section('content')
<div class="col-sm-9 padding-right">
@include('alerts.alerts')
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">

            @if(count($product->images))
                <img src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}" width="200" alt="" />
            @else
                <img src="{{ url('images/no-img.jpg') }}" width="200" alt="" />
            @endif

            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($product->images as $images)
                            <a href="#"><img src="{{ url('uploads/'.$product->images->first()->id.'.'.$product->images->first()->extension) }}" width="80" alt="" /></a>
                        @endforeach
                    </div>

                </div>

            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->

                <h2>{{ $product->category->name }} | {{ $product->name }}</h2>

                <p>{{ $product->description }}</p>

                {!! Form::open(['route'=>['cart.add', $product->id], 'method'=>'get']) !!}
                <span>

                <!-- cor -->
                <div class="form-group">
                <h6 class="font-alt">Cor:</h6>
                    <div class="btn-group" data-toggle="buttons">
                    @foreach($product->colors as $color)
                    
                    <label class="btn" style="background-color:{{$color->name}};">
                        <input type="radio" value="{{$color->name}}" name="color" id="{{$color->name}}" autocomplete="off"/>
                        <i class="fa fa-check"></i>
                    </label>
        
                    @endforeach
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit"class="btn btn-default"><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</button>
                </div>

                </span>
                {!! Form::close() !!}

                <!--<span>
                    <span>R$ {{ number_format($product->price,2,",",".") }}</span>
                        <a href="{{ route('cart.add', ['id'=>$product->id]) }}" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Adicionar no Carrinho
                        </a>
                </span>-->
                <!-- Submit Button -->

            </div>
            <!--/product-information-->
        </div>
        <div class="col-sm-7">
            <h2>Tags</h2>
            @foreach($product->tags as $tag)
                <a href="{{ route('store.tag', ['id'=>$tag->id]) }}"><span class="label label-info">{{$tag->name}}</span></a>
            @endforeach
        </div>
    </div>
    <!--/product-details-->
</div>
@stop