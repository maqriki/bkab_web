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
        Edit Guide
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Akun</li>
        <li class="active">Guide</li>
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
              <form class="form-horizontal" method="POST" action="{{ url('guide/update', $guide->id) }}">
                {{ csrf_field() }}
                <div class="box-body" style="padding: 15px">
                  <div class="row no-margin">
                    <h4>Data Guide</h4>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Nama</label>
                      <div class="col-md-4">
                        <input name="name" type="text" class="form-control" placeholder="" value="{{$guide->nama}}">
                      </div>
                      <label class="control-label col-md-2">NIK</label>
                      <div class=" col-md-4">
                        <input name="NIK" type="text" class="form-control" placeholder="" value="{{$guide->NIK}}">
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Umur</label>
                      <div class="col-md-4">
                        <input name="usia" type="number" min="12" max="99" class="form-control" placeholder="" value="{{$guide->umur}}">
                      </div>
                      <label class="control-label col-md-2">Jenis Kelamin</label>
                      <div class=" col-md-4">
                        <select class="form-control" name="jk">
                          <option value="{{$guide->jenis_kelamin}}">{{$guide->jenis_kelamin}}</option>
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">No Telpon</label>
                      <div class=" col-md-4">
                        <input name="phone" type="text" class="form-control" placeholder="" value="{{$guide->telpon}}">
                      </div>
                      <label class="control-label col-md-2">Email</label>
                      <div class=" col-md-4">
                        <input name="email" type="text" class="form-control" placeholder="" value="{{$guide->email}}">
                      </div>                        
                    </div>
                    <div class="form-group" style="margin-right: 0;">
                      <label class="control-label col-md-2">Alamat</label>
                      <div class=" col-md-10">
                        <textarea name="alamat" type="text" class="form-control" placeholder="">{{$guide->alamat}}</textarea>
                      </div>                        
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn bg-deep-purple own-btn pull-right">Submit</button>
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