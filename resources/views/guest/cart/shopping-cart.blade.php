@extends('guest.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')
  <link rel="stylesheet" href="{{ asset('min/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
			  	@if($cart['totalPaket']>0)
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading"><b><center>Paket Wisata</center></b></div>
							  <div class="panel-body">
						  		<table class="table">
						  			<?php $numberPaket =1; ?>
						  			@foreach($paket as $pakets)
						  				<tr class="bg-grey-100">
						  					<th colspan="3">#{{$numberPaket}}</th>
						  				</tr>
							  			<tr>
							  				<th width="30%">Paket Wisata</th>
							  				<th width="10px">:</th>
							  				<td>{{$pakets['paket']['pw_name']}}</td>
							  			</tr>
							  			<tr>
							  				<th width="30%">Pengunjung</th>
							  				<th width="10px">:</th>
							  				<td>{{$pakets['person']}} <b>x</b> Rp. {{ number_format($pakets['price'], 0) }}</td>
							  			</tr>
							  			<tr>
							  				<th width="30%">Total Biaya Paket Wisata</th>
							  				<th width="10px">:</th>
							  				<td>Rp. {{ number_format($pakets['totalPrice'], 0) }}</td>
							  			</tr>
							  			<tr class="bg-grey"><th colspan="3" style="padding: 1px !important"></th></tr>
						  				<?php $numberPaket=$numberPaket+1; ?>
						  			@endforeach
						  		</table>
							  </div>
							</div>
						</div>
					@endif
			  	@if($cart['totalTicketing']>0)
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading"><b><center>Tiket Retribusi</center></b></div>
							  <div class="panel-body">
							  		<table class="table">
							  			<?php $number =1; ?>
							  			@foreach($tiket as $tikets)
							  				<tr class="bg-grey-100">
							  					<th colspan="3">#{{$number}}</th>
							  				</tr>
								  			<tr>
								  				<th width="30%">Lokasi Wisata</th>
								  				<th width="10px">:</th>
								  				<td>{{$tikets['item']['lokasi_name']}}</td>
								  			</tr>
								  			<tr>
								  				<th>Tiket Dewasa</th>
								  				<th width="10px">:</th>
								  				<td>{{$tikets['dewasa']}} <b>x</b> Rp. {{ number_format($tikets['hargaDewasa'], 2) }}</td>
								  			</tr>
								  			<tr>
								  				<th>Tiket Anak</th>
								  				<th width="10px">:</th>
								  				<td>{{$tikets['anak']}}  <b>x</b> Rp. {{ number_format($tikets['hargaAnak'], 2) }}</td>
								  			</tr>
								  			<tr>
								  				<th>Tanggal Kunjungan</th>
								  				<th width="10px">:</th>
								  				<td>{{$tikets['date']}}</td>
								  			</tr>
								  			<tr>
								  				<th>Total Retribusi Lokasi Wisata</th>
								  				<th width="10px">:</th>
								  				<td>Rp. {{ number_format($tikets['tPrice'], 0) }}</td>
								  			</tr>
								  			<tr class="bg-grey"><th colspan="3" style="padding: 1px !important"></th></tr>
								  			<?php $number=$number+1; ?>
							  			@endforeach
							  		</table>
							  </div>
							</div>
						</div>
					@endif
				</div>
							
			</div>

			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading"><b><center>Resume Shopping Cart</center></b></div>
				  <div class="panel-body">
				  	<table class="table">
				  		<tr>
				  			<th width="130px">Total Item</th>
				  			<th width="10px">:</th>
				  			<td>{{$cart['totalQty']}}</td>
				  		</tr>
				  		@if($cart['totalPaket']>0)
					  		<tr>
					  			<th>Item Paket</th>
					  			<th>:</th>
					  			<td>{{$cart['totalPaket']}}</td>
					  		</tr>
					  	@endif
					  	@if($cart['totalTicketing']>0)
					  		<tr>
					  			<th>Item Ticketing</th>
					  			<th>:</th>
					  			<td>{{$cart['totalTicketing']}}</td>
					  		</tr>
					  	@endif
				  		<tr>
				  			<th>Total Tagihan</th>
				  			<th>:</th>
				  			<td>Rp. {{ number_format($cart['totalPrice'], 0) }}</td>
				  		</tr>
				  	</table>
				  </div>
				  <div class="panel-footer clearfix">
				  	<a href="{{ url('/checkout') }}" class="btn btn-sm bg-teal col-white"> Checkout</a>
				  	<a href="{{ url('/remove-cart') }}" class="btn btn-sm bg-teal col-white pull-right"> Remove Cart</a>
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