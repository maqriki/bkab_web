@extends('visitor.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')
  <link rel="stylesheet" href="{{ asset('min/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <style type="text/css">
  	.panel-body{
  		padding: 25px
  	}
  	.col-lg-4{
  		min-height: 100px;
  		border:1px solid #DDD;
  		padding: 15px;
  	}
  	.own-row{
  		margin-top: 10px
  	}
  </style>
@endsection

@section('content')

<div class="container">
	<form class="form-horizontal" method="POST" action="{{ url('submit-shopping-cart' ) }}">
		{{ csrf_field() }}
		<div class="row">

			<div class="col-md-8">
				<div class="panel panel-default">
				  <div class="panel-heading"><b><center>Pembayaran</center></b></div>
				  <div class="panel-body">
				  	<div class="row">
				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="Bank Transfer" required> Transfer Bank<br>
				  			<img src="{{ asset('assets/images/transfer.png') }}" height="40px" style="margin-top: 15px">
				  		</div>

				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="Mandiri ClickPay"> Mandiri ClickPay<br>
				  			<img src="{{ asset('assets/images/mandiriclick.png') }}" height="40px" style="margin-top: 15px">
				  		</div>
				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="Mandiri e-Cash"> Mandiri e-Cash<br>
				  			<img src="{{ asset('assets/images/mandiriecash.png') }}" height="40px" style="margin-top: 15px">
				  		</div>
				  	</div>
				  	<div class="row own-row">
				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="BCA KlikPay"> BCA KlikPay<br>
				  			<img src="{{ asset('assets/images/bcaclick.png') }}" height="40px" style="margin-top: 15px">
				  		</div>
				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="Klik BCA"> Klik BCA<br>
				  			<img src="{{ asset('assets/images/clickbca.jpg') }}" height="40px" style="margin-top: 15px">
				  		</div>
				  		<div class="col-lg-4">
				  			<input type="radio" name="paymentMethod" value="Kartu Kredit"> Kartu Kredit<br>
				  			<img src="{{ asset('assets/images/cc.png') }}" height="40px" style="margin-top: 15px">
				  		</div>
				  	</div>
				  </div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading"><b><center>Resume</center></b></div>
				  <div class="panel-body">
				  	<table class="table">
				  			<tr>
				  				<th>Jumlah Item</th>
				  				<th>{{ $totalQty }}</th>
				  			</tr>
				  			<tr>
				  				<th>Jumlah Ticket</th>
				  				<th>{{ $totalTicket }}</th>
				  			</tr>
				  			<tr>
				  				<th>Sub Total</th>
				  				<th>Rp. {{ number_format($totalPrice, 2) }}</th>
				  			</tr>
				  	</table>
				  </div>
				  <div class="panel-footer clearfix">
				  	<a href="{{ url('/visit') }}" class="btn btn-sm btn-info pull-left">Kembali Belanja</a>
				  	<a href="{{ url('/ticketing/delete-cart') }}" style="margin-left: 15px" class="btn btn-sm btn-warning pull-right">Delete Cart</a>
				  	<button type="submit" href="{{ url('/ticketing/checkout') }}" class="btn btn-sm btn-success pull-right">Check Out</button>
				  </div>
				</div>
			</div>

			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><b><center>Detail Cart</center></b></div>
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
				</div>
			</div>

			
		</div>
	</form>
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