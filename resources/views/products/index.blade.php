@extends('app')
@section('content')
	<div class="container">
		<h1>Products</h1>
		@include('alerts.alerts')
		<a href="{{ route('admin.products.create') }}", class="btn btn-default">New Product</a>
		<br/>
		<br/>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
			@foreach($products as $product)
			<tr>
				<td>{{ $product->id }}</td>
				<td>{{ $product->name }}</td>
				<td>{{ str_limit($product->description, $limit = 100, $end = '...') }}</td>
				<td>{{ $product->price }}</td>
				<td>
					<a href="{{ route('admin.products.edit', ['id'=>$product->id]) }}">Edit</a> | 
					<a href="{{ route('admin.products.images', ['id'=>$product->id]) }}">Image</a> | 
					<a href="{{ route('admin.products.destroy', ['category'=>$product->id]) }}">Delete</a>
				</td>
			</tr>
			@endforeach
		</table>
		{!! $products->render() !!}
	</div>
@endsection