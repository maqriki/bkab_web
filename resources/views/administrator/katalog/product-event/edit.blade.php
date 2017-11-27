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
              <form class="form-horizontal" method="POST" action="{{ url('a/admin/product-event/update', $data->prod_id) }}">
                {{ csrf_field() }}
                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label>Nama Lokasi Wisata</label>
                        <input name="name" type="text" class="form-control input-sm" placeholder="Nama Lokasi Wisata" value="{{$data->prod_name}}">
                      </div>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="textarea" name="description" placeholder="Place some text here" rows="23" 
                          style="width: 100%; font-size: 13px; line-height: 15px; border: 1px solid #dddddd; padding: 10px;">{{$data->prod_description}}</textarea>
                      </div>
                    </div>
                    <div class="col-lg-5">

                      <div class="row">
                        <div class="col-lg-12">
                          <label>Kategori</label>
                          <select class="form-control input-sm" name="category">
                            <option value="{{$data->prod_category}}">{{$data->prod_category}}</option>
                            @foreach($kategori as $kat)
                            <option value="{{$kat->kat_name}}">{{$kat->kat_name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                        </div>
                        <div class=" col-lg-6">
                          <label>Tanggal Mulai</label>
                          <input type="text" name="prod_start" class="form-control input-sm" id="datemask" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{$data->prod_start_date}}">
                        </div>
                        <div class=" col-lg-6">
                          <label>Tanggal Selsai</label>
                          <input type="text" name="prod_end" class="form-control input-sm" id="datemask2" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask value="{{$data->prod_end_date}}">
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Harga</label>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="p_usd" value="{{$data->prod_price_usd}}">
                          </div>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="p_idr" value="{{$data->prod_price_idr}}">
                          </div>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Retribusi</label>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="r_usd" value="{{$data->prod_retrib_usd}}">
                          </div>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="r_idr" value="{{$data->prod_retrib_idr}}">
                          </div>
                        </div>
                      </div>
                      
                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Total Biaya</label>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="tp_usd" value="{{$data->prod_tp_usd}}">
                          </div>
                        </div>
                        <div class=" col-lg-6">
                          <div class="input-group">
                            <span class="input-group-addon">Rp</span>
                            <input type="text" class="form-control input-sm" placeholder="" name="tp_idr" value="{{$data->prod_tp_idr}}">
                          </div>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Lokasi</label>
                          <input type="text" class="form-control input-sm" placeholder="" name="location" value="{{$data->prod_location}}">
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Alamat</label>
                          <textarea class="form-control input-sm" style="max-width: 100%;min-width: 100%" name="address">{{$data->prod_address}}</textarea>
                        </div>
                      </div>

                      <div class="row mt-5px">
                        <div class="col-lg-12">
                          <label>Maps</label>
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="Latitude" name="lat" value="{{$data->prod_lat}}">
                        </div>
                        <div class=" col-lg-6">
                            <input type="text" class="form-control input-sm" placeholder="Longitude" name="long" value="{{$data->prod_long}}">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-header with-border">
                  <h3 class="box-title"><b>Jadwal Kunjungan</b></h3>
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

                        <div class="col-lg-7 _col">
                          <input type="text" name="sch-des{{$sc}}" class="form-control input-sm" value="{{$schl->psch_description}}">
                        </div>
                        
                        <div class="col-lg-4 _col">
                          <input type="text" name="sch-time{{$sc}}" class="form-control input-sm" value="{{$schl->psch_time}}">
                        </div>
                      </div>
                    <?php $sc++; ?>
                    @endforeach
                      
                      <div class="row mt-5px">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 _col">
                          <a class="btn own-btn bg-dark-gray btn-sm add_sch pull-right"><i class="fa fa-plus"></i></a>
                        </div>

                        <div class="col-lg-7 _col">
                          <input type="text" name="sch-des{{$sc}}" class="form-control input-sm">
                        </div>
                        
                        <div class="col-lg-4 _col">
                          <input type="text" name="sch-time{{$sc}}" class="form-control input-sm">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="box-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <h4 class="box-title"><b>Include</b></h4>
                      <div class="row">
                        <div class="col-lg-12" id="_incl">
                          <?php $in=0; ?>
                          @foreach($include as $incl)
                            <div class="row mt-5px">

                              <div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">
                                <a class="btn own-btn bg-red btn-sm r-incl pull-right"><i class="fa fa-minus"></i></a>
                              </div>

                              <div class="col-lg-9 _col">
                                <input type="text" name="incl[{{$in}}]" class="form-control input-sm" value="{{$incl->pincl_description}}">
                              </div>
                            </div>
                          <?php $in++; ?>
                          @endforeach

                            <div class="row mt-5px">

                              <div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">
                                <a class="btn own-btn bg-dark-gray btn-sm add-incl pull-right"><i class="fa fa-plus"></i></a>
                              </div>

                              <div class="col-lg-9 _col">
                                <input type="text" name="incl[{{$in}}]" class="form-control input-sm">
                              </div>
                            </div>
                        </div>

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <h4 class="box-title"><b>Exclude</b></h4>
                      <div class="row">
                        <div class="col-lg-12" id="_exc">
                        <?php $ex=0; ?>
                        @foreach($exclude as $excl)
                          <div class="row mt-5px">

                            <div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">
                              <a class="btn own-btn bg-red btn-sm r-exc pull-right"><i class="fa fa-minus"></i></a>
                            </div>

                            <div class="col-lg-10 _col">
                              <input type="text" name="exc[{{$ex}}]" class="form-control input-sm" value="{{$excl->pexcl_description}}">
                            </div>
                          </div>
                        <?php $ex++; ?>
                        @endforeach
                          <div class="row mt-5px">

                            <div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">
                              <a class="btn own-btn bg-dark-gray btn-sm add-exc pull-right"><i class="fa fa-plus"></i></a>
                            </div>

                            <div class="col-lg-10 _col">
                              <input type="text" name="exc[{{$ex}}]" class="form-control input-sm">
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
<!-- InputMask -->
<script src="{{ asset('/min/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{ asset('/min/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{ asset('/min/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

<!-- DataTables -->
<script src="{{ asset('/min/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    $('#datemask2').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });

  // Schedule
  var _sch = <?php echo json_encode($sc); ?>;
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
    e.preventDefault();
    $(this).parent().parent().remove();
  });

  // Include
  var _inc = <?php echo json_encode($in); ?>;
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
    $(this).parent().parent().remove();
  });

  // Exclude
  var _exc = <?php echo json_encode($ex); ?>;
  $('#_exc').on("click",".add-exc", function(e){
    e.preventDefault();
    _exc++;
      $('#_exc').append('<div class="row mt-5px">'+
                            '<div class="col-lg-2 col-md-1 col-sm-1 col-xs-5 _col">'+
                              '<a class="btn bg-red own-btn r-exc pull-right btn-sm"><i class="fa fa-minus"></i></a>'+
                            '</div>'+
                            '<div class="col-lg-10 _col">'+
                              '<input type="text" name="exc['+_exc+']" class="form-control input-sm">'+
                            '</div>'+
                          '</div>'); 
  });

  $('#_exc').on("click",".r-exc", function(e){
    e.preventDefault();
    $(this).parent().parent().remove();
  });

});
</script>

@endsection