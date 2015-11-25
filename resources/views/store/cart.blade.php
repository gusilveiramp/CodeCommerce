@extends('store.store')

@section('content')
    <section id="cart_items">
    	<div class="container">
    		<div class="table-responsive cart_info">
    			<table class="table table-condensed">
    				<thead>
    					<tr class="cart_menu">
    						<td class="image">Item</td>
    						<td class="description"></td>
    						<td class="price">Price</td>
    						<td class="price">Qtd</td>
    						<td class="price">Total</td>
    						<td></td>
    					</tr>
    				</thead>

    				<tbody>

    				@forelse($cart->all() as $k=>$item)
    					<tr>
    						<td class="cart_product">
    							<a href="{{ route('store.product', ['id'=>$k]) }}">
    								Imagem
    							</a>
    						</td>
    						<td class="cart_description">
    							<h4><a href="{{ route('store.product', ['id'=>$k]) }}">{{ $item['name'] }}</a></h4>
    							<p>Code: {{ $k }}</p>
    						</td>

    						<td class="cart_price">
    							R$ {{ $item['price'] }}
    						</td>

    						<td class="cart_quantity">
    						<a href="{{ route('cart.add', ['id'=>$k]) }}" class="cart_quantity_delete"><span class="glyphicon glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>
                                {{ $item['qtd'] }}
                            <a href="{{ route('cart.remove', ['id'=>$k]) }}" class="cart_quantity_delete"><span class="glyphicon glyphicon glyphicon-minus-sign disabled" aria-hidden="true"></span></a>
    						</td>

    						<td class="cart_total">
    							<p class="cart_total_price">R$ {{ $item['price'] * $item['qtd'] }}</p>
    						</td>
    						<td class="cart_delete">
    							<a href="{{ route('cart.destroy', ['id'=>$k]) }}" class="cart_quantity_delete">Delete</a>
    						</td>
    					</tr>
                    @empty
                        <tr>
                            <td class="" colspan="5">
                                <br>
                                <center><p>No items found. Go buy something!</p></center>
                            </td>
                        </tr>
    				@endforelse

                    <tr class="cart_menu">
                        <td colspan="6">
                            <div class="pull-right">
                                <span>
                                    TOTAL: R$ {{ $cart->getTotal() }}
                                </span>

                                <a href="{{route('checkout.place')}}" class="btn btn-success">Go to checkout</a>
                            </div>
                        </td>
                    </tr>

    				</tbody>
    			</table>
    		</div>
    	</div>
    </section>
@stop