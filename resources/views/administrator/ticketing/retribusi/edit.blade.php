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
        Edit Data Retribusi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Ticket</li>
        <li class="active">Retribusi</li>
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
              <h3 class="box-title"><b>Data Lokasi Wisata</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th width="170px">Nama Lokasi Wisasta</th>
                        <th width="10px">:</th>
                        <td>{{$data->lokasi_name}}</td>
                      </tr>
                      <tr>
                        <th>Tipe / Kategori</th>
                        <th width="10px">:</th>
                        <td>{{$data->lokasi_type}} / {{$data->lokasi_category}}</td>
                      </tr>
                      <tr>
                        <th>Lokasi</th>
                        <th width="10px">:</th>
                        <td>{{$data->lokasi_location}}</td>
                      </tr>
                      <tr>
                        <th>Alamat</th>
                        <th width="10px">:</th>
                        <td>{{$data->lokasi_address}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              
              <form class="form-horizontal" method="POST" action="{{ url('a/admin/ticketing/update', $data->lokasi_id) }}">
                {{ csrf_field() }}
                <input type="text" name="lokasi" style="display: none;" value="{{$data->lokasi_name}}">
                <div class="box-body" style="padding: 15px">
                  <h3>Retribusi</h3>
                  <div class="row no-margin">
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h4><u>Pengunjung</u></h4>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-6">Pengunjung Dewasa  (Rp.)</label>
                            <div class="col-md-6">
                              <input name="dewasa" type="number" min="0" class="form-control" value="{{$retribusi->harga_dewasa}}">
                            </div>                          
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-6">Pengunjung Anak  (Rp.)</label>
                            <div class="col-md-6">
                              <input name="anak" type="number" min="0" class="form-control" value="{{$retribusi->harga_anak}}">
                            </div>                          
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <h4><u>Kendaraan</u></h4>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-5">Bus Besar (Rp.)</label>
                            <div class="col-md-7">
                              <input name="busBesar" type="number" min="0" class="form-control" value="{{$retribusi->harga_bus_besar}}">
                            </div>                          
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-5">Bus (Rp.)</label>
                            <div class="col-md-7">
                              <input name="bus" type="number" min="0" class="form-control" value="{{$retribusi->harga_bus_kecil}}">
                            </div>                          
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-5">Mobil (Rp.)</label>
                            <div class="col-md-7">
                              <input name="mobil" type="number" min="0" class="form-control" value="{{$retribusi->harga_mobil}}">
                            </div>                          
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group" style="margin-right: 0;">
                            <label class="col-md-5">Motor (Rp.)</label>
                            <div class="col-md-7">
                              <input name="motor" type="number" min="0" class="form-control" value="{{$retribusi->harga_motor}}">
                            </div>                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="box-footer" style="padding: 15px">
                  <div class="row">
                    <div class="col-lg-11">
                      <button type="submit" class="btn bg-deep-purple own-btn"><i class="fa fa-check"></i> Submit</button>
                    </div>
                  </div>
                  
                </div>
              </form>
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
                            '<div class="col-lg-4 _col">'+
                              '<input type="text" name="sch-des'+_sch+'" class="form-control" placeholder="Nama Fasilitas">'+
                            '</div>'+

                            '<div class="col-lg-7 _col">'+
                              '<input type="text" name="sch-time'+_sch+'" class="form-control" placeholder="Keterangan">'+
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
                              '<input type="text" name="incl['+_inc+']" class="form-control _fc">'+
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
                              '<input type="text" name="exc['+_exc+']" class="form-control">'+
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