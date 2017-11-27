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
        Tambah Operator Retriibusi
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Akun</li>
        <li class="active">Operator Retribusi</li>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" action="{{ url('ot/store') }}">
                {{ csrf_field() }}
                <div class="box-body" style="padding: 15px">
                  <div class="row no-margin">
                    <h4>Data Operator</h4>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Nama Operator</label>
                      <div class=" col-md-10">
                        <input name="name" type="text" class="form-control" placeholder="">
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">No telp</label>
                      <div class=" col-md-10">
                        <input name="phone" type="text" class="form-control" placeholder="">
                      </div>                        
                    </div>
                    <h4>Data Akun</h4>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Username</label>
                      <div class=" col-md-10">
                        <input name="username" type="text" class="form-control" placeholder="">
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Lokasi Wisata</label>
                      <div class=" col-md-10">
                        <select class="form-control" name="lokasi_id">
                          <option value="">-- Pilih Lokasi Wisata --</option>
                          @foreach($lok as $lokasi)
                            <option value="{{$lokasi->lokasi_id}}">{{$lokasi->lokasi_name}}</option>
                          @endforeach
                        </select>
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Password</label>
                      <div class=" col-md-10">
                        <input name="password" type="password" class="form-control" placeholder="">
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Confirm Password</label>
                      <div class=" col-md-10">
                        <input name="possword_confirm" type="password" class="form-control" placeholder="">
                      </div>                        
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
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