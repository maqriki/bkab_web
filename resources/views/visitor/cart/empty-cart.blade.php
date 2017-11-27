@extends('visitor.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')
  <link rel="stylesheet" href="{{ asset('min/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('content')

	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><b><center>Empty Cart</center></b></div>
				  <div class="panel-body"></div>
				</div>
			</div>

			
		</div>
	</div>

@endsection

@section('custom-script')
<!-- bootstrap datepicker -->
<script src="{{ asset('min/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script type="text/javascript">
	$(function(){
    //Date picker
    $('#datepicker').datepicker({
    	format: 'dd/mm/yyyy',
	    startDate: '0d',
      autoclose: true
    })
	})
</script>
@endsection