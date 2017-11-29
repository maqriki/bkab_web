@extends('member.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')

@endsection

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
		  	<form class="form-horizontal" method="POST" action="{{url('/member/profile/update')}}">
		  		{{ csrf_field() }}
					<div class="panel panel-primary">
					  <div class="panel-heading"><b>Edit Profile</b></div>
					  <div class="panel-body">

					  	<table class="table">
					  		<tr class="bg-grey-100">
					  			<th style="text-align: center;">Data Pribadi</th>
					  		</tr>
					  		<tr>
					  			<th></th>
					  		</tr>
					  	</table>

						  <div class="form-group">
						    <label class="control-label col-sm-2">Nama:</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" value="{{$user->name}}" name="name">
						    </div>
						  </div>
						  <div class="form-group">
						    <label class="control-label col-sm-2">Email:</label>
						    <div class="col-sm-4"> 
						      <input type="text" class="form-control" value="{{$user->email}}" name="email">
						    </div>
						    <label class="control-label col-sm-2">Telpon:</label>
						    <div class="col-sm-4"> 
						      <input type="text" class="form-control" value="{{$user->phone}}" name="phone">
						    </div>
						  </div>
						  @if(empty($profile))
							  <div class="form-group">
							    <label class="control-label col-sm-2">Alamat:</label>
							    <div class="col-sm-10">
							      <textarea class="form-control" name="address"></textarea>
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Kabupaten / Kota:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="kabupaten">
							    </div>
							    <label class="control-label col-sm-2">Propinsi:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="state">
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Negara:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="country">
							    </div>
							    <label class="control-label col-sm-2">Kode Pos:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="zip_code">
							    </div>
							  </div>

						  	<table class="table">
						  		<tr class="bg-grey-100">
						  			<th style="text-align: center;">Sosial Media</th>
						  		</tr>
						  		<tr>
						  			<th></th>
						  		</tr>
						  	</table>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Facebook:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="fb">
							    </div>
							    <label class="control-label col-sm-2">Twitter:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="twitter">
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Instagram:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="ig">
							    </div>
							    <label class="control-label col-sm-2">Path:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" name="path">
							    </div>
							  </div>
							 @else
							  <div class="form-group">
							    <label class="control-label col-sm-2">Alamat:</label>
							    <div class="col-sm-10">
							      <textarea class="form-control" name="address">{{$profile->address}}</textarea>
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Kabupaten / Kota:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->kabupaten}}" name="kabupaten">
							    </div>
							    <label class="control-label col-sm-2">Propinsi:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->state}}" name="state">
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Negara:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->country}}" name="country">
							    </div>
							    <label class="control-label col-sm-2">Kode Pos:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->zip_code}}" name="zip_code">
							    </div>
							  </div>

						  	<table class="table">
						  		<tr class="bg-grey-100">
						  			<th style="text-align: center;">Sosial Media</th>
						  		</tr>
						  		<tr>
						  			<th></th>
						  		</tr>
						  	</table>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Facebook:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->fb}}" name="fb">
							    </div>
							    <label class="control-label col-sm-2">Twitter:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->twitter}}" name="twitter">
							    </div>
							  </div>
							  <div class="form-group">
							    <label class="control-label col-sm-2">Instagram:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->ig}}" name="ig">
							    </div>
							    <label class="control-label col-sm-2">Path:</label>
							    <div class="col-sm-4"> 
							      <input type="text" class="form-control" value="{{$profile->path}}" name="path">
							    </div>
							  </div>
							 @endif
					  </div>
					  <div class="panel-footer clearfix">
					  	<button type="submit" class="btn btn-sm btn-default pull-right"> Update Profile</button>
					  </div>
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('custom-script')

@endsection