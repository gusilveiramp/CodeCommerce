@extends('app')
@section('content')
	<div class="container">
		<h1>Create Product</h1>

		@if($errors->any())
			<ul class="alert">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		@endif
		
		{!! Form::open(['route'=>['admin.products.update', $product->id], 'method'=>'put']) !!}
		
		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('category', 'Category:') !!}
			{!! Form::select('category_id', $categories, $product->category->id, ['class'=>'form-control']) !!}
		</div>

		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
		</div>

		<!-- Description Form Input -->
		<div class="form-group">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', $product->description, ['class'=>'form-control']) !!}
		</div>

		<!-- Price Form Input -->
		<div class="form-group">
			{!! Form::label('price', 'Price:') !!}
			<div class="input-group">
				<div class="input-group-addon">$</div>
				{!! Form::input('number','price', $product->price, ['class'=>'form-control','placeholder'=>'00,00']) !!}
			</div>
		</div>

		<!-- Feature Form Input -->
		<div class="form-group">
			{!! Form::label('featured', 'Featured:') !!}
			{!! Form::checkbox('featured', 1, $product->featured) !!}
			&nbsp;&nbsp;
			{!! Form::label('recommended', 'Recommended:') !!}
			{!! Form::checkbox('recommended', 1, $product->recommended) !!}
		</div>

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Product', ['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.products') }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>
@endsection