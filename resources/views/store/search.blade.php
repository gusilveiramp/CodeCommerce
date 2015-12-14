@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items "><!--features_items-->
        <h2 class="title text-center">Search results</h2>
       		@include('store.partial.product')
       		{!!$products->render()!!}
        </div><!--features_items-->
    </div>
@stop