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
				  <div class="panel-heading"><b><center>List Cart</center></b></div>
				  <div class="panel-body">
				  	<table class="table">
				  		<thead>
				  			<tr>
				  				<th>Lokasi Wisata</th>
				  				<th>Ticket Dewasa</th>
				  				<th>Ticket Anak</th>
				  				<th>Tanggal</th>
				  				<th>Tagihan</th>
				  			</tr>
				  		</thead>
				  		<tbody>
				  			@foreach($cart as $carts)
					  			<tr>
					  				<td>{{$carts['item']['lokasi_name']}}</td>
					  				<td>{{$carts['dewasa']}} <b>x</b> Rp. {{ number_format($carts['hargaDewasa'], 2) }}</td>
					  				<td>{{$carts['anak']}}  <b>x</b> Rp. {{ number_format($carts['hargaAnak'], 2) }}</td>
					  				<td>{{$carts['date']}}</td>
					  				<td>Rp. {{ number_format($carts['tPrice'], 2) }}</td>
					  			</tr>
					  		@endforeach
				  		</tbody>
					  	<tfoot>
					  		<tr>
					  			<th style="background: #DDD" colspan="4">Total Tagihan</th>
					  			<th style="background: #DDD">Rp. {{ number_format($totalPrice, 2) }}</th>
					  		</tr>
					  	</tfoot>	
				  	</table>
				  </div>
				  <div class="panel-footer clearfix">
				  	<a href="{{ url('/ticketing/delete-cart') }}" style="margin-left: 15px" class="btn btn-sm btn-warning pull-right">Delete Cart</a>
				  	<a href="{{ url('/ticketing/checkout') }}" class="btn btn-sm btn-success pull-right">Check Out</a>
				  </div>
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