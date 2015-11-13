@extends('app')
@section('content')
	<div class="container">
		<h1>Upload Image</h1>

		@include('alerts.alerts')

		{!! Form::open(['route'=>['admin.products.images.store', $product->id], 'method'=>'post', 'enctype'=>"multipart/form-data"]) !!}
		
		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('image', 'Image:') !!}
			{!! Form::file('image', null, ['class'=>'form-control']) !!}
		</div>

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Upload Image', ['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.products.images', ['id'=>$product->id]) }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>
@endsection