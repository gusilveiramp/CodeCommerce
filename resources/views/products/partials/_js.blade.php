@section('scripts')
{!! Html::script('js/bootstrap-tagsinput.js') !!}

  <script type="text/javascript">
    $(document).ready(function(e){
		$('tags').tagsinput('items')
	});
  </script>
@stop