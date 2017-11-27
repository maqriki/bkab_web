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
        Guide
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
              <div class="col-lg-4">
                <h4>Data Guide</h4>
              </div>
              <div class="col-lg-8">
                <a href="{{ url('/guide/destroy', $guide->id) }}" class="btn btn-sm btn-danger pull-right own-btn"><i class="fa fa-trash"></i> Delete</a>
                <a href="{{ url('/guide/edit', $guide->id) }}" class="btn btn-sm btn-warning pull-right own-btn"><i class="fa fa-edit"></i> Edit</a>
                <a href="{{ url('/guide/create') }}" class="btn btn-sm bg-teal pull-right own-btn"><i class="fa fa-plus"></i> Tambah Guide</a>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
                <tr>
                  <th width="20%">Nama Lengkap</th>
                  <th width="10px">:</th>
                  <td>{{$guide->nama}}</td>
                </tr>
                <tr>
                  <th>NIK</th>
                  <th width="10px">:</th>
                  <td>{{$guide->NIK}}</td>
                </tr>
                <tr>
                  <th>Telpon</th>
                  <th width="10px">:</th>
                  <td>{{$guide->telpon}}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <th width="10px">:</th>
                  <td>{{$guide->email}}</td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <th width="10px">:</th>
                  <td>{{$guide->jenis_kelamin}}</td>
                </tr>
                <tr>
                  <th>Umur</th>
                  <th width="10px">:</th>
                  <td>{{$guide->umur}}</td>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <th width="10px">:</th>
                  <td>{{$guide->alamat}}</td>
                </tr>
              </table>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-12">
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <div class="col-lg-4">
                <h4>List Guide</h4>
              </div>              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table no-margin" id="example2">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Telpon</th>
                  <th>Jenis Kelamin</th>
                  <th>Usia</th>
                  <th>Status Guide</th>
                  <th width="230px"></th>
                </tr>
                </thead>
                  @foreach($allGuide as $g)
                    <tr>
                      <td>{{$g->nama}}</td>
                      <td>{{$g->telpon}}</td>
                      <td>{{$g->jenis_kelamin}}</td>
                      <td>{{$g->umur}} tahun</td>
                      <td>
                        @if($g->status_guide=="1")
                          <label class="label label-success">Aktif</label>
                        @else
                          <label class="label label-danger">Non Aktif</label>
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('/guide/destroy', $g->id) }}" class="btn btn-xs btn-danger pull-right own-btn"><i class="fa fa-trash"></i> Delete</a>
                        <a href="{{ url('/guide/edit', $g->id) }}" class="btn btn-xs btn-warning pull-right own-btn"><i class="fa fa-edit"></i> Edit</a>
                        <a href="{{ url('/guide/show', $g->id) }}" class="btn btn-xs btn-info pull-right own-btn"><i class="fa fa-eye"></i> view</a>
                      </td>
                    </tr>
                  @endforeach
                <tbody>
                </tbody>
              </table>
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