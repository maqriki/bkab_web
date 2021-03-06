@extends('visitor.part.app')


@section('title')
	Pariwisata Batang
@endsection

@section('custom-style')

@endsection

@section('content')

	<div class="container">
		<div class="row">
			@foreach($lokasi as $lok)
				<div class="col-lg-4">
					<div class="panel panel-default">
					  <div class="panel-heading"><b>{{$lok->lokasi_name}}</b></div>
					  <div class="panel-body">{!!substr($lok->lokasi_description,0,100)!!}...</div>
					  <div class="panel-footer clearfix">
					  	<a href="{{ url('/lokasi/view', $lok->lokasi_slug) }}" 
					  		class="btn btn-sm btn-info pull-right"> View</a>
					  </div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

@endsection

@section('custom-script')

@endsection