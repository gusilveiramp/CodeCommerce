@extends('app')

@include('products.partials._css')

@section('content')
	<div class="container">
		<h1>Edit Product</h1>

		@include('alerts.alerts')
		
		{!! Form::model($product, ['route'=>['admin.products.update', $product->id], 'method'=>'put']) !!}
		
		@include('products.partials._form')
		
		<!-- Input Tags -->
		{!! Form::label('tags', 'Tags:', ['class'=>'control-label']) !!}
		<div class="form-group">
		{!! Form::text('tags', $product->tagList, ['class'=>'form-control', 'data-provide'=>'typeahead', 'placeholder'=>'Insert your tags here...']) !!}
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