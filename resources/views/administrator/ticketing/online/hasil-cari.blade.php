@extends('administrator.part.base')

@section('title') Administrator @endsection

@section('custom-style')
  <link rel="stylesheet" href="{{ asset('/min/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <style type="text/css">
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header{
      height: 90px;
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
        Retribusi Lokasi Wisata
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('administrator-dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Katalog</li>
        <li class="active">Retribusi Lokasi Wisata</li>
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
              <h3 class="box-title">List Retribusi Lokasi Wisata</h3>
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
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="table-responsive">
                <table class="table no-margin" id="example2">
                  <thead>
                  <tr>
                    <th>Dewasa</th>
                    <th>Anak</th>
                    <th>Total Retribusi</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>{{$retribusi->tiket_dewasa}}</td>
                        <td>{{$retribusi->tiket_anak}}</td>
                        <td>Rp. {{$retribusi->total_retrib}}</td>
                        <td>
                          <a href="{{ url('a/admin/ticketing/online-penjualan', $retribusi->order_id) }}" class="btn own-btn btn-xs pull-right bg-blue" title="view"><i class="fa fa-eye"></i> Lihat</a>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
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
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

@endsection


@section('custom-script')

<!-- DataTables -->
<script src="{{ asset('/min/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('/min/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    })
  })
</script>

@endsection