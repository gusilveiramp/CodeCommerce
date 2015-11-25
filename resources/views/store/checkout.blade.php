@extends('store.store')

@section('categories')
    @include('store.partial.categories')
@stop

@section('content')
<div class="col-sm-9 padding-right">
    @if(empty($order))
        <h3>Cart empty! :(</h3>
    @else
        <h3>Congratulations!</h3>
        <p>The request #{{$order->id}} was successfully sent.
        </p>
    @endif
</div>
@stop