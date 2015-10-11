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

		{!! Form::open(['route'=>'admin.products.store', 'method'=>'post']) !!}
		
		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('category', 'Category:') !!}
			{!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
		</div>

		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>

		<!-- Description Form Input -->
		<div class="form-group">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['class'=>'form-control']) !!}
		</div>

		<!-- Price Form Input -->
		<div class="form-group">
			{!! Form::label('price', 'Price:') !!}
			<div class="input-group">
				<div class="input-group-addon">$</div>
				{!! Form::text('price', null, ['class'=>'form-control']) !!}
				<div class="input-group-addon">.00</div>
			</div>
		</div>

		<!-- Feature Form Input -->
		<div class="form-group">
			{!! Form::label('featured', 'Featured:') !!}
			{!! Form::checkbox('featured', 1, null) !!}
			&nbsp;&nbsp;
			{!! Form::label('recommended', 'Recommended:') !!}
			{!! Form::checkbox('recommended', 1, null) !!}
		</div>

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Product', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection