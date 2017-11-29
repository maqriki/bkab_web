@extends('member.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')

@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
				  <div class="panel-heading"><b>Account</b></div>
				  <div class="panel-body">
				  	<table class="table">
				  		<tr>
				  			<th width="20%">Nama</th>
				  			<th width="10px">:</th>
				  			<td>{{$user->name}}</td>
				  		</tr>
				  		<tr>
				  			<th>Email</th>
				  			<th width="10px">:</th>
				  			<td>{{$user->email}}</td>
				  		</tr>
				  		<tr>
				  			<th>New Password</th>
				  			<th width="10px">:</th>
				  			<td><input type="password" name="" class="form-control" style="width: 50%"></td>
				  		</tr>
				  		<tr>
				  			<th>Confirm New Password</th>
				  			<th width="10px">:</th>
				  			<td><input type="password" name="" class="form-control" style="width: 50%"></td>
				  		</tr>
				  	</table>
				  </div>
				  <div class="panel-footer clearfix"> <button class="btn btn-sm btn-default pull-right"> Update Account</button> </div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('custom-script')

@endsection