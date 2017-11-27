@extends('visitor.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')
	<style type="text/css">
		.al{
			text-align: left !important;
		}
	</style>
@endsection

@section('content')

	<div class="container">
		<div class="row">
				<div class="col-lg-7">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>Order</b></div>
					  <div class="panel-body">
							<h5>Invoice : <b>#{{$order->order_id}}</b></h5>
							<h5>Tagihan : <b>Rp. {{ number_format($order->total_payment, 2) }}</b></h5>
							<h5>Jumlah Tiket : <b>{{$order->total_ticket}}</b></h5>
							@if($order->status_payment==0)
								<h5>Status Pembayaran : <b><label class="label label-danger"> Belum Dibayar</label></b></h5>
							@elseif($order->status_payment==2)
								<h5>Status Pembayaran : <b><label class="label label-primary"> Menunggu Konfirmasi</label></b></h5>
							@else
								<h5>Status Pembayaran : <b><label class="label label-success"> Sudah Dibayar</label></b></h5>
							@endif
							<hr>
							<h5><b>Detail Order</b></h5>
							<table class="table">
								@foreach($detailOrd as $key=>$ordDetail)
									<tr>
										<th style="background: #F5F8FA" colspan="3">#{{$key+1}}</th>
									</tr>
									<tr>
										<th width="240px">Nama Lokasi</th>
										<th width="5px">:</th>
										<td>{{$ordDetail->lokasi_nama}}</td>
									</tr>
									<tr>
										<th>Jumlah Tiket (Dewasa/Anak)</th>
										<th width="5px">:</th>
										<td>{{$ordDetail->tiket_dewasa+$ordDetail->tiket_anak}} ( {{$ordDetail->tiket_dewasa}} / {{$ordDetail->tiket_anak}} )</td>
									</tr>
									<tr>
										<th>Total Retribusi</th>
										<th width="5px">:</th>
										<td>Rp. {{ number_format($ordDetail->total_retrib, 2) }}</td>
									</tr>
									<tr>
										<th>Status Tiket</th>
										<th width="5px">:</th>
										<td>
											@if($ordDetail->status_kunjungan == 1)
												<label class="label label-info">Sudah Dipakai</label>
											@elseif($ordDetail->status_kunjungan == 2)
												<label class="label label-primary">Menunggu Konfirmasi</label>
											@else
												<label class="label label-success">Aktif</label>
											@endif
										</td>
									</tr>
								@endforeach
							</table>			  	
					  </div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>Other Other</b></div>
					  <div class="panel-body">
							<table class="table">
					  		<thead>
					  			<tr>
					  				<th>Invoice</th>
						  			<th></th>
					  			</tr>						  			
					  		</thead>
					  		<tbody>
					  			@foreach($other as $ord)
					  				<tr>
					  					<td>#{{$ord->order_id}}</td>
					  					<td>
					  						<div class="btn-group pull-right">
											    <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">
											    <span class="caret"></span></button>
											    <ul class="dropdown-menu" role="menu">
							  						@if($ord->status_payment==0)
							  							<li><a href="{{ url('/user/order/konfirmasi-pembayaran', $ord->order_id) }}"><i class="fa fa-dollar"></i> Konfirmasi Pembayaran</a></li>
							  						@endif
											      <li><a href="{{ url('/user/order/detail', $ord->order_id) }}"><i class="fa fa-eye"></i> Detail</a></li>
											    </ul>
											  </div>
					  						
					  					</td>
					  				</tr>
					  			@endforeach
					  		</tbody>
					  	</table>				  	
					  </div>
					</div>
				</div>
		</div>
	</div>

@endsection

@section('custom-script')

@endsection