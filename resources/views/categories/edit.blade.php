@extends('app')
@section('content')
	<div class="container">
		<h1>Editing Category: {{$category->name}}</h1>

		@include('alerts.alerts')

		{!! Form::model($category, ['route'=>['admin.categories.update', $category->id], 'method'=>'put']) !!}

		@include('categories.partials._form')

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Category', ['class'=>'btn btn-primary form-control']) !!}
			<a href="{{ route('admin.categories') }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>
@endsection