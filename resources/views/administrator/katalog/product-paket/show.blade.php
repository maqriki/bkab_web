@extends('administrator.part.base')

@section('title') Administrator @endsection

@section('custom-style')
  <link rel="stylesheet" href="{{ asset('/min/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <style type="text/css">
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header{
      height: 90px;
    }
    .btn{font-size: 12px;}
    .wysihtml5-toolbar li:last-child {
        display: none;
      }
      .btn-sm{
        padding: 3px 8px;
        margin-top: 2px;
        font-size: 12px;
        line-height: 1.5;
      }
  </style>
@endsection

@section('content')

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lokasi Wisata
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Katalog</li>
        <li class="active">Lokasi Wisata</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-success">
            <div class="box-header with-border">
              <!-- <h3 class="box-title"><b>Main Data</b></h3> -->
              <a href="{{ url('a/admin/product/destroy', $data->prod_id) }}" class="btn own-btn btn-xs pull-right bg-red" title="delete"><i class="fa fa-trash"></i> Delete</a>
              <a href="{{ url('a/admin/product/edit', $data->prod_id) }}" class="btn own-btn btn-xs pull-right bg-orange" title="edit"><i class="fa fa-edit"></i> Edit</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <h5><u><b>Nama Lokasi Wisata</b></u></h5>
                  <h4><b>{{$data->prod_name}}</b></h4>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12">
                  <h5><u><b>Deskripsi</b></u></h5>
                  {!! $data->prod_description !!}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-6">
                  <h5><u><b>Lokasi</b></u></h5>
                  {{ $data->prod_location }}
                </div>
                <div class="col-lg-6">
                  <h5><u><b>Alamat</b></u></h5>
                  {{ $data->prod_address }}
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-12">
                  <h5><u><b>Keterangan</b></u></h5>
                </div>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Retribusi</th>
                    <th>Harga Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ $data->prod_category }}</td>
                    <td>$ {{$data->prod_price_usd}} <b>//</b> Rp.{{$data->prod_price_idr}}</td>
                    <td>$ {{$data->prod_retrib_usd}} <b>//</b> Rp.{{$data->prod_retrib_idr}}</td>
                    <td>$ {{$data->prod_tp_usd}} <b>//</b> Rp.{{$data->prod_tp_idr}}</td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <div class="row">
                <div class="col-lg-12">
                  <h5><u><b>Schedule</b></u></h5>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($schedule as $sc)
                      <tr>
                        <td>{{$sc->psch_description}}</td>
                        <td>{{$sc->psch_time}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-lg-6">
                  <h5><u><b>Include</b></u></h5>
                  <table class="table">
                    @foreach($include as $incl)
                    <tr>
                      <td>{{$incl->pincl_description}}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <div class="col-lg-6">
                  <h5><u><b>Exclude</b></u></h5>
                  <table class="table">
                    @foreach($exclude as $excl)
                    <tr>
                      <td>{{$excl->pexcl_description}}</td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <div class="control-sidebar-bg"></div>

@endsection


@section('custom-script')

<!-- DataTables -->
<script src="{{ asset('/min/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();

  // Schedule
  var _sch = 0;
  $('#_sch').on("click",".add_sch", function(e){
    e.preventDefault();
    _sch++;
      $('#_sch').append('<div class="row mt-5px">'+
                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r-sch pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-7 _col">'+
                              '<input type="text" name="sch-des'+_sch+'" class="form-control input-sm">'+
                            '</div>'+

                            '<div class="col-lg-4 _col">'+
                              '<input type="text" name="sch-time'+_sch+'" class="form-control input-sm">'+
                            '</div>'+
                          '</div>'); 
  });

  $('#_sch').on("click",".r-sch", function(e){
    e.preventDefault();_sch--;
    $(this).parent().parent().remove();
  });

  // Include
  var _inc = 0;
  $('#_incl').on("click",".add-incl", function(e){
    e.preventDefault();
    _inc++;
      $('#_incl').append('<div class="row mt-5px">'+

                            '<div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r-incl pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-9 _col">'+
                              '<input type="text" name="incl['+_inc+']" class="form-control _fc input-sm">'+
                            '</div>'+
                          '</div>');  
  });

  $('#_incl').on("click",".r-incl", function(e){
    e.preventDefault();
     _inc--;
    $(this).parent().parent().remove();
  });

  // Exclude
  var _exc = 0;
  $('#_exc').on("click",".add-exc", function(e){
    e.preventDefault();
    _exc++;
      $('#_exc').append('<div class="row mt-5px">'+
                            '<div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r-esc pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-10 _col">'+
                              '<input type="text" name="exc['+_exc+']" class="form-control input-sm">'+
                            '</div>'+
                          '</div>'); 
  });

  $('#_exc').on("click",".r-esc", function(e){
    e.preventDefault();
    _exc--;
    $(this).parent().parent().remove();
  });

});
</script>

@endsection