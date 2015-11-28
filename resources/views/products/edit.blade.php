@extends('app')

@include('products.partials._css')

@section('content')
	<div class="container">
		<h1>Edit Product</h1>

		@include('alerts.alerts')
		
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
				{!! Form::input('number','price', $product->price, ['class'=>'form-control','placeholder'=>'00']) !!}
			</div>
		</div>

		<!-- Input Tags -->
		{!! Form::label('tags', 'Tags:', ['class'=>'control-label']) !!}
		<div class="form-group">
		{!! Form::text('tags', $product->tagList, ['class'=>'form-control', 'data-provide'=>'typeahead', 'placeholder'=>'Insert your tags here...']) !!}
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
			{!! Form::submit('Save Edit', ['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.products') }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>

@endsection

@include('products.partials._js')