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
			<div class="col-lg-8">
				<div class="row">

					<div class="col-md-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>{{$lokasi->lokasi_name}}</b></div>
						  <div class="panel-body">{!! $lokasi->lokasi_description !!}</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Fasilitas</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		@foreach($fasilitas as $fas)
						  		<tr>
						  			<th>{{$fas->fasilitas}}</th>
						  			<td>{{$fas->fasilitas_keterangan}}</td>
						  		</tr>
						  		@endforeach
						  	</table>
						  </div>
						</div>
					</div>

				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Informasi Retribusi</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		<tr>
						  			<th colspan="2" style="background: #DDD">Pengunjung</th>
						  		</tr>
						  		<tr>
						  			<th>Dewasa</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_dewasa, 2) }}</td>
						  		</tr>
						  		<tr>
						  			<th>Anak</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_anak, 2) }}</td>
						  		</tr>
						  		<tr>
						  			<th colspan="2" style="background: #DDD">Kendaraan</th>
						  		</tr>
						  		<tr>
						  			<th>Bus Besar</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_bus_besar, 2) }}</td>
						  		</tr>
						  		<tr>
						  			<th>Bus</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_bus_kecil, 2) }}</td>
						  		</tr>
						  		<tr>
						  			<th>Mobil</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_mobil, 2) }}</td>
						  		</tr>
						  		<tr>
						  			<th>Motor</th>
						  			<td style="text-align: right;">Rp. {{ number_format($harga->harga_motor, 2) }}</td>
						  		</tr>
						  	</table>
						  </div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Pemesanan Tiket Retribusi</b></div>
						  <div class="panel-body">
						  	<form class="form-horizontal" method="GET" action="{{ url('/ticketing/add-to-cart/'.$lokasi->lokasi_id.'/'.$lokasi->lokasi_slug ) }}">
						  		{{ csrf_field() }}
								  <div class="form-group">
								    <label class="control-label col-sm-4" for="email">Pengunjung:</label>
								  </div>
								  <div class="form-group">
								    <label class="control-label col-sm-4" for="pwd">Dewasa:</label>
								    <div class="col-sm-8"> 
								      <input name="dewasa" type="number" min="0" class="form-control" id="pwd" placeholder="Dewasa" required="">
								    </div>
								  </div>
								  <div class="form-group">
								    <label class="control-label col-sm-4" for="pwd">Anak-Anak:</label>
								    <div class="col-sm-8"> 
								      <input name="anak" type="number" min="0" class="form-control" id="pwd" placeholder="Anak-Anak">
								    </div>
								  </div>
								  <div class="form-group">
								    <label class="control-label col-sm-4" for="pwd">Tanggal:</label>
								    <div class="col-sm-8"> 
								      <input name="date" type="text" class="form-control" id="datepicker" placeholder="Tanggal Kunjungan" required="">
								    </div>
								  </div>
								  <div class="form-group"> 
								    <div class="col-sm-12">
								      <button type="submit" class="btn btn-default pull-right">Submit</button>
								    </div>
								  </div>
								</form>
						  </div>
						</div>
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