@extends('visitor.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')

@endsection

@section('content')

	<div class="container">
		<div class="row">
				<div class="col-lg-5">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>Profile</b></div>
					  <div class="panel-body">
					  	<table class="table">
					  		<tr>
					  			<th>Nama</th>
					  			<th width="10px">:</th>
					  			<td>{{$user->name}}</td>
					  		</tr>
					  		<tr>
					  			<th>No Telp</th>
					  			<th width="10px">:</th>
					  			<td>{{$user->phone}}</td>
					  		</tr>
					  		<tr>
					  			<th>Email</th>
					  			<th width="10px">:</th>
					  			<td>{{$user->email}}</td>
					  		</tr>
					  		<tr>
					  			<th>Alamat</th>
					  			<th width="10px">:</th>
					  			<td></td>
					  		</tr>
					  	</table>
					  </div>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>Order History</b></div>
					  <div class="panel-body">
					  	<table class="table">
					  		<thead>
					  			<tr>
					  				<th>Invoice</th>
						  			<th>Total Tagihan</th>
						  			<th>Total Tiket</th>
						  			<th>Status Pembayaran</th>
						  			<th></th>
					  			</tr>						  			
					  		</thead>
					  		<tbody>
					  			@foreach($order as $ord)
					  				<tr>
					  					<td>#{{$ord->order_id}}</td>
					  					<td>Rp.{{ number_format($ord->total_payment, 2) }}</td>
					  					<td>{{$ord->total_ticket}}</td>
					  					<td>
					  						@if($ord->status_payment==0)
					  							<label class="label label-danger">Belum Dibayar</label>
					  						@elseif($ord->status_payment==2)
					  							<label class="label label-primary">Menunggu Konfirmasi</label>
					  						@else
					  							<label class="label label-success">Sudah Dibayar</label>
					  						@endif
					  					</td>
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