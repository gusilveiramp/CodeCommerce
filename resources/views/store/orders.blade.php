@extends('store.store')

@section('content')
<div class="container">

    <h3>Meus pedidos</h3>
    <table class="table">

    	<thead>
    	<tr>
    		<th>#ID</th>
    		<th>Items</th>
            <th>Value per unit</th>
    		<th>Total value</th>
    		<th>Status</th>
    	</tr>
		</thead>

        <tbody>
		@foreach($orders as $order)
    	<tr>
    		<td>{{$order->id}}</td>
    		<td>
        		<ul>
        			@foreach($order->items as $item)
    				<li>{{ $item->qtd }} x {{ $item->product->name }}</li>
        			@endforeach
        		</ul>
    		</td>
            <td><ul>
                    @foreach($order->items as $item)
                    <li>US$ {{ $item->price }}</li>
                    @endforeach
                </ul></td>
    		<td>{{$order->total}}</td>
    		<td>{{$order->status}}</td>
    	</tr>
    	@endforeach
    	</tbody>

    </table>
</div>
@stop