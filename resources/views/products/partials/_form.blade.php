<!-- Name Form Input -->
<div class="form-group">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<!-- Category Form Input -->
<div class="form-group">
	{!! Form::label('category', 'Category:') !!}
	{!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
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