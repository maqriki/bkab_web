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
        Edit Lokasi Wisata
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
              <h3 class="box-title"><b>Main Data</b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="POST" action="{{ url('a/admin/event-wisata/update', $data->lokasi_id) }}">
                {{ csrf_field() }}
                <div class="box-body" style="padding: 15px">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group" style="margin-right: 0">
                        <label>Nama Lokasi Wisata</label>
                        <input name="name" type="text" class="form-control" placeholder="Nama Lokasi Wisata" value="{{$data->lokasi_name}}">
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="textarea" name="description" placeholder="Place some text here" rows="23" 
                          style="width: 100%; font-size: 13px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;">{{$data->lokasi_description}}</textarea>
                      </div>
                    </div>
                    <div class="col-lg-5">

                      <div class="row">
                        <div class="col-lg-12">
                          <label>Kategori</label>
                          <select class="form-control" name="category">
                            <option value="{{$data->lokasi_category}}">{{$data->lokasi_category}}</option>
                            @foreach($kategori as $kat)
                            <option value="{{$kat->kat_name}}">{{$kat->kat_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Tanggal Pelaksanaan</label>
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control" placeholder="Tanggal Mulai" name="start" value="{{$data->lokasi_start}}">
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control" placeholder="Tanggal Selsai" name="end" value="{{$data->lokasi_end}}">
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Lokasi</label>
                          <input type="text" class="form-control" placeholder="" name="location" value="{{$data->lokasi_location}}">
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Alamat</label>
                          <textarea class="form-control" rows="7" style="max-width: 100%;min-width: 100%" name="address">{{$data->lokasi_address}}</textarea>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Maps</label>
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control" placeholder="Latitude" name="lat" value="{{$data->lokasi_lat}}">
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control" placeholder="Longitude" name="long" value="{{$data->lokasi_long}}">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Fasilitas</b></h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12" id="_sch">
                    <?php $sc=0; ?>
                    @foreach($schedule as $schl)
                      <div class="row mt-5px">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                          <a class="btn own-btn bg-red btn-sm r-sch pull-right"><i class="fa fa-minus"></i></a>
                        </div>

                        <div class="col-lg-4 _col">
                          <input type="text" name="sch-des{{$sc}}" class="form-control" value="{{$schl->fasilitas}}">
                        </div>
                        
                        <div class="col-lg-7 _col">
                          <input type="text" name="sch-time{{$sc}}" class="form-control" value="{{$schl->fasilitas_keterangan}}">
                        </div>
                      </div>
                    <?php $sc++; ?>
                    @endforeach
                      
                      <div class="row mt-5px">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                          <a class="btn own-btn bg-dark-gray btn-sm add_sch pull-right"><i class="fa fa-plus"></i></a>
                        </div>

                        <div class="col-lg-4 _col">
                          <input type="text" name="sch-des{{$sc}}" class="form-control" placeholder="Nama Fasilitas">
                        </div>
                        
                        <div class="col-lg-7 _col">
                          <input type="text" name="sch-time{{$sc}}" class="form-control" placeholder="Keterangan Fasilitas">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

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
  var _sch = <?php echo json_encode($sc); ?>;
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
    e.preventDefault();
    $(this).parent().parent().remove();
  });

});
</script>

@endsection