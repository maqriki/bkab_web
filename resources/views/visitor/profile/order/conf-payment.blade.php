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
								@endforeach
							</table>			  	
					  </div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>Konfirmasi Pembayaran</b></div>
					  <div class="panel-body">

							<form class="form-horizontal" method="POST" action="{{ url('user/order/konfirmasi-pembayaran', $order->order_id ) }}">
								{{ csrf_field() }}
								<h5>Invoice : <b>#{{$order->order_id}}</b></h5>
								<h5>Tagihan : <b>Rp. {{ number_format($order->total_payment, 2) }}</b></h5>
								<hr>
								<div class="form-group">
							    <label class="control-label col-sm-4 al">Bank Tujuan:</label>
							    <div class="col-sm-8"> 
							      <select class="form-control input-sm">
							      	<option value="">-- Pilih --</option>
							      	<option value="BRI">BRI</option>
							      	<option value="BNI">BNI</option>
							      	<option value="BCA">BCA</option>
							      	<option value="Mandiri">Mandiri</option>
							      </select>
							    </div>
							  </div>
								<div class="form-group">
							    <label class="control-label col-sm-4 al">Jumlah Transfer:</label>
							    <div class="col-sm-8"> 
							      <input type="text" name="" class="form-control input-sm">
							    </div>
							  </div>
							  <hr>
								<div class="form-group">
							    <label class="control-label col-sm-4 al">Bank Pengirim:</label>
							    <div class="col-sm-8"> 
							      <select class="form-control input-sm">
							      	<option value="">-- Pilih --</option>
							      	<option value="BRI">BRI</option>
							      	<option value="BNI">BNI</option>
							      	<option value="BCA">BCA</option>
							      	<option value="Mandiri">Mandiri</option>
							      </select>
							    </div>
							  </div>
								<div class="form-group">
							    <label class="control-label col-sm-4 al">Nama Nasabah:</label>
							    <div class="col-sm-8"> 
							      <input type="text" name="" class="form-control input-sm">
							    </div>
							  </div>
								<div class="form-group">
							    <label class="control-label col-sm-4 al">No Rek.:</label>
							    <div class="col-sm-8"> 
							      <input type="text" name="" class="form-control input-sm">
							    </div>
							  </div>
							  <hr>
							  <button type="submit" class="btn btn-sm btn-success"> Submit</button>
							</form>					  	
					  </div>
					</div>
				</div>
		</div>
	</div>

@endsection

@section('custom-script')

@endsection