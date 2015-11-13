@extends('app')
@section('content')
	<div class="container">
		<h1>Create Category</h1>

		@include('alerts.alerts')

		{!! Form::open(['route'=>'admin.categories.store', 'method'=>'post']) !!}

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

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
		</div>

		{!! Form::close() !!}
	</div>
@endsection