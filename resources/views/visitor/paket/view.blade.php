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
						  <div class="panel-heading"><b>{{$pw->pw_name}}</b></div>
						  <div class="panel-body">{!! $pw->pw_description !!}</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Fasilitas</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		@foreach($pwf as $key=>$pwfas)
							  		<tr>
							  			<th>#{{$key+1}}</th>
							  			<td>{{$pwfas->pwf_fasilitas}}</td>
							  			<td>{{$pwfas->pwf_description_1}}</td>
							  			<td>{{$pwfas->pwf_description_2}}</td>
							  		</tr>
						  		@endforeach
						  	</table>
						  </div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Itenerary</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		@foreach($pwi as $key=>$itin)
							  		<tr>
							  			<th>#{{$key+1}}</th>
							  			<td>{{$itin->pwi_itenerary}}</td>
							  			<td>{{$itin->pwi_description_1}}</td>
							  			<td>{{$itin->pwi_description_2}}</td>
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
						  <div class="panel-heading"><b></b></div>
						  <div class="panel-body">
						  	<b>Durasi : {{ $pw->pw_duration }}</b><br>
						  	<b>Harga : Rp. {{ number_format($pw->pw_price_idr, 2) }}</b> / Orang
						  </div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Lokasi Wisata</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		@foreach($pwl as $key=>$lokasi)
							  		<tr>
							  			<th>{{$lokasi->lokasi_name}}</th>
							  			<td><a target="_blank" href="{{ url('/lokasi/view', $lokasi->lokasi_slug)}}" class="btn btn-sm bg-blue-grey col-white pull-right"><i class="fa fa-eye"></i> View</a></td>
							  		</tr>
						  		@endforeach
						  	</table>
						  </div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Exclude</b></div>
						  <div class="panel-body">
						  	<table class="table">
						  		@foreach($pwe as $key=>$pwexcl)
							  		<tr>
							  			<th>#{{$key+1}}</th>
							  			<td>{{$pwexcl->pwe_exclude}}</td>
							  		</tr>
						  		@endforeach
						  	</table>
						  </div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="panel panel-default">
						  <div class="panel-heading"><b>Pemesanan Paket Wisata</b></div>
						  <div class="panel-body">
						  	<form class="form-horizontal" method="GET" action="{{ url('/paket/add-to-cart/'.$pw->pw_id.'/'.$pw->pw_slug)}}">
						  		{{ csrf_field() }}
								  <div class="form-group">
								  </div>
								  <div class="form-group">
								    <label class="control-label col-sm-5" for="pwd">Jumlah Orang:</label>
								    <div class="col-sm-7"> 
								      <input name="person" type="number" min="0" class="form-control" id="pwd" placeholder="Dewasa" required="">
								    </div>
								  </div>
								  <input type="text" name="price" value="{{$pw->pw_price_idr}}" style="display: none;">
								  <div class="form-group">
								    <label class="control-label col-sm-5" for="pwd">Tanggal:</label>
								    <div class="col-sm-7"> 
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