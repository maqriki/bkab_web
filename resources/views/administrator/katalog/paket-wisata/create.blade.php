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
        Tambah Paket Wisata
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Katalog</li>
        <li class="active">Paket Wisata</li>
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
            <div class="box-body" style="padding: 0 25px">
              <form class="form-horizontal" method="POST" action="{{ url('a/admin/paket-wisata/store') }}">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Nama Paket Wisata</label>
                        <input name="pw_name" type="text" class="form-control input-sm" placeholder="Nama Paket Wisata">
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="textarea" name="pw_description" placeholder="Place some text here" rows="23" 
                          style="width: 100%; font-size: 13px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                    </div>
                    <div class="col-lg-5">

                      <div class="row">
                        <div class="col-lg-12">
                          <label>Kategori</label>
                          <select class="form-control input-sm" name="pw_category">
                            <option value="">-- Pilih --</option>
                            @foreach($kategori as $kat)
                            <option value="{{$kat->kat_name}}">{{$kat->kat_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Harga</label>
                          <div class="row">
                            <div class=" col-lg-6">
                              <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control input-sm" placeholder="" name="pw_usd">
                              </div>
                            </div>
                            <div class=" col-lg-6">
                              <div class="input-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control input-sm" placeholder="" name="pw_idr">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Waktu Perjalanan Paket Wisata</label>
                          <div class="row">
                            <div class=" col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="" name="pw_start">
                            </div>
                            <div class=" col-lg-6">
                                <input type="text" class="form-control input-sm" placeholder="" name="pw_end">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-5px">
                          
                        <div class="col-lg-12">
                          <label>Durasi</label>
                          <input type="text" class="form-control input-sm" placeholder="" name="pw_duration">
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="box-header with-border">
                      <h3 class="box-title"><b>Lokasi Wisata</b></h3>
                    </div>
                    
                    @foreach($wisata as $key=>$wisatas)
                      <div class="col-lg-4" style="padding: 10px">
                        <input type="checkbox" name="lokasiW[]" value="{{$wisatas->lokasi_id}}"> {{$wisatas->lokasi_name}}
                      </div>
                    @endforeach
                  </div>
                </div>
                <hr>
                <!-- /.box-body -->
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Jadwal Kunjungan</b></h3>
                </div>
                <div class="box-body">
                  <div class="row">

                    <div class="col-lg-12" id="_pwi">
                        <input type="text" name="pwi_now[0]" value="0" style="display: none;">
                      <div class="row clearfix _mb-0">

                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                          <a class="btn own-btn bg-dark-gray btn-sm add_pwi pull-right"><i class="fa fa-plus"></i></a>
                        </div>

                        <div class="col-lg-7 _col">
                          <input type="text" name="pwi_des0" class="form-control input-sm" placeholder="Jadwal">
                        </div>
                        
                        <div class="col-lg-2 _col">
                          <input type="text" name="pwi_time0" class="form-control input-sm" placeholder="Start Pukul">
                        </div>
                        
                        <div class="col-lg-2 _col">
                          <input type="text" name="pwi_dur0" class="form-control input-sm" placeholder="Durasi">
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
                <!-- /.box-body -->
                <hr>
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Fasilitas</b></h3>
                </div>
                <div class="box-body">
                  <div class="row">

                    <div class="col-lg-12" id="_fas">
                      <div class="row clearfix _mb-0">
                        <input name="fas_now[0]" value="0" style="display: none;">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                          <a class="btn own-btn bg-dark-gray btn-sm add_fas pull-right"><i class="fa fa-plus"></i></a>
                        </div>

                        <div class="col-lg-5 _col">
                          <input type="text" name="fas0" class="form-control input-sm" placeholder="Fasilitas">
                        </div>
                        
                        <div class="col-lg-3 _col">
                          <input type="text" name="fas_1des0" class="form-control input-sm" placeholder="Keterangan #1">
                        </div>
                        
                        <div class="col-lg-3 _col">
                          <input type="text" name="fas_2des0" class="form-control input-sm" placeholder="Keterangan #2">
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
                <hr>

                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <h4 class="box-title"><b>Exclude</b></h4>
                      <div class="row">

                        <div class="col-lg-12" id="_exc">
                          <div class="row clearfix _mb-0">

                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                              <a class="btn own-btn bg-dark-gray btn-sm add-exc pull-right"><i class="fa fa-plus"></i></a>
                            </div>

                            <div class="col-lg-11 _col">
                              <input type="text" name="exc[0]" class="form-control input-sm">
                            </div>
                          </div>
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
    $("form").submit(function(){
        checked = $("input[type=checkbox]:checked").length;
        if (checked < 2) {
          alert("Lokasi Wisata Kosong, Silahkan Pilih Lokasi Wisata");
          return false;
        }
    });
    $('.textarea').wysihtml5();

  // Schedule
  var _pwi = 0;
  $('#_pwi').on("click",".add_pwi", function(e){
    e.preventDefault();
    _pwi++;
      $('#_pwi').append('<div class="row mt-5px">'+
                            '<input name="pwi_now['+_pwi+']" value="'+_pwi+'" style="display: none;">'+
                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r_pwi pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-7 _col">'+
                              '<input type="text" name="pwi_des'+_pwi+'" class="form-control input-sm" placeholder="Jadwal" value="">'+
                            '</div>'+

                            '<div class="col-lg-2 _col">'+
                              '<input type="text" name="pwi_time'+_pwi+'" class="form-control input-sm" placeholder="Start Pukul">'+
                            '</div>'+

                            '<div class="col-lg-2 _col">'+
                              '<input type="text" name="pwi_dur'+_pwi+'" class="form-control input-sm" placeholder="Durasi">'+
                            '</div>'+
                          '</div>'); 
  });

  $('#_pwi').on("click",".r_pwi", function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  // Fasilitas
  var _fas = 0;
  $('#_fas').on("click",".add_fas", function(e){
    e.preventDefault();
    _fas++;
      $('#_fas').append('<div class="row mt-5px">'+
                            '<input name="fas_now['+_fas+']" value="'+_fas+'" style="display: none;">'+
                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r_fas pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-5 _col">'+
                              '<input type="text" name="fas'+_fas+'" class="form-control input-sm" placeholder="Fasilitas">'+
                            '</div>'+

                            '<div class="col-lg-3 _col">'+
                              '<input type="text" name="fas_1des'+_fas+'" class="form-control input-sm" placeholder="Keterangan #1">'+
                            '</div>'+

                            '<div class="col-lg-3 _col">'+
                              '<input type="text" name="fas_2des'+_fas+'" class="form-control input-sm" placeholder="Keterangan #2">'+
                            '</div>'+
                          '</div>'); 
  });

  $('#_fas').on("click",".r_fas", function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  // Exclude
  var _exc = 0;
  $('#_exc').on("click",".add-exc", function(e){
    e.preventDefault();
    _exc++;
      $('#_exc').append('<div class="row mt-5px">'+
                            '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r-esc pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-11 _col">'+
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