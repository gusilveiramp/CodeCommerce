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
</script>
@stop