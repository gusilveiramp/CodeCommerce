@extends('app')

@include('products.partials._css')

@section('content')
	<div class="container">
		<h1>Create Product</h1>

		@include('alerts.alerts')

		{!! Form::open(['route'=>'admin.products.store', 'method'=>'post']) !!}
		
		@include('products.partials._form')
		
		<!-- Input Color -->
		<div class="form-group">
			{!! Form::label('cor', 'Cor:') !!}
			<div class="input_fields_wrap" id="wrap">
			<a href="#" class="add_field_button"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add new</a>
			<div>
				<input type="color" name="color[]" value="#000000">
				<a href="#" class="remove_field"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Remove</a>
			</div>
			</div>
		</div>

		<!-- Input Tags -->
		{!! Form::label('tags', 'Tags:', ['class'=>'control-label']) !!}
		<div class="form-group">
		{!! Form::text('tags', null, ['class'=>'form-control', 'data-provide'=>'typeahead', 'placeholder'=>'Insert your tags here...']) 
		!!}
		</div>

		<!-- Submit Button -->
		<div class="form-group">
			{!! Form::submit('Add Product', ['class'=>'btn btn-primary']) !!}
			<a href="{{ route('admin.products') }}", class="btn btn-default">Back</a>
		</div>

		{!! Form::close() !!}
	</div>
@endsection
@section('scripts')
{!! Html::script('js/bootstrap-tagsinput.js') !!}
{!! Html::script('js/bootstrap-3-typehead.js') !!}

  	<script type="text/javascript">
	$(document).ready(function(e){

		var taglist = <?php echo $tags ?>;
		
		$("input[data-provide='typeahead']").tagsinput({
		  typeahead: {
		    source: taglist
		  }
		});
	});

	var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var count           = 1;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="color" name="color['+count+']"><a href="#" class="remove_field"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span> Remove</a></div>');
            count++;
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
	});
	</script>

@endsection