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
				  <div class="panel-heading clearfix"><b>Profile</b> <a href="{{url('/member/profile/edit')}}" class="btn btn-sm btn-default pull-right"> Edit Profile</a> </div>
				  <div class="panel-body">
				  	<table class="table">
				  		<tr class="bg-grey-100">
				  			<th colspan="6" style="text-align: center;">Data Diri</th>
				  		</tr>
				  		<tr>
				  			<th width="20%">Nama</th>
				  			<th width="10px">:</th>
				  			<td colspan="4">{{$user->name}}</td>
				  		</tr>
				  		<tr>
				  			<th>No Telp</th>
				  			<th width="10px">:</th>
				  			<td colspan="4">{{$user->phone}}</td>
				  		</tr>
				  		<tr>
				  			<th>Email</th>
				  			<th width="10px">:</th>
				  			<td colspan="4">{{$user->email}}</td>
				  		</tr>
				  		@if(!empty($profile))
					  		<tr>
					  			<th>Alamat</th>
					  			<th width="10px">:</th>
					  			<td colspan="4">{{$profile->address}}</td>
					  		</tr>
					  		<tr>
					  			<th>Kota/Kabupaten</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->kabupaten}}</td>
					  			<th width="20%">Propinsi</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->state}}</td>
					  		</tr>
					  		<tr>
					  			<th>Negara</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->country}}</td>
					  			<th width="20%">Kode Pos</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->zip_code}}</td>
					  		</tr>
					  		<tr>
					  			<th colspan="6" style="text-align: center;"></th>
					  		</tr>
					  		<tr class="bg-grey-100">
					  			<th colspan="6" style="text-align: center;">Sosial Media</th>
					  		</tr>
					  		<tr>
					  			<th>Facebook</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->country}}</td>
					  			<th width="20%">Twitter</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->zip_code}}</td>
					  		</tr>
					  		<tr>
					  			<th>Instagram</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->country}}</td>
					  			<th width="20%">Path</th>
					  			<th width="10px">:</th>
					  			<td>{{$profile->zip_code}}</td>
					  		</tr>
					  	@endif
				  	</table>
				  </div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('custom-script')

@endsection