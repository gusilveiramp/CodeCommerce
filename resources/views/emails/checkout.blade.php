<h1>Hi <strong>{{$user->name}}</strong>,</h1>
<p>Thank you very much for choosing us!<br/>Your purchase was successfully completed!</p>
<hr>
<div class="container">
    <h3>Order details:</h3>
    <table class="table">

    	<thead>
    	<tr>
    		<th>Order Number</th>
    		<th>Items</th>
    		<th>Total Paid</th>
    		<th>Status</th>
    	</tr>
		</thead>

        <tbody>
    	<tr>
    		<td>{{$order->id}}</td>
    		<td>
        		<ul>
        			@foreach($order->items as $item)
    				<li>{{ $item->qtd }} x {{ $item->product->name }}</li>
        			@endforeach
        		</ul>
    		</td>
    		<td>
                <ul>
                    <li>R$ {{$order->total}}</li>
                </ul>
            </td>
    		<td>Preparing for shipping.</td>
    	</tr>
    	</tbody>
    </table>
</div>
<hr>
<p>Best regards,<br/>
CodeCommerce Shop Ltda.</p>