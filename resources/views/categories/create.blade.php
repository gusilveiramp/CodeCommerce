@extends('app')
@section('content')
	<div class="container">
		<h1>Create Category</h1>

		@include('alerts.alerts')

		{!! Form::open(['route'=>'admin.categories.store', 'method'=>'post']) !!}

		@include('categories.partials._form')

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.categories') }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>
@endsection