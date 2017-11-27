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
      .no-border{
        background: transparent;
        border: none;
      }
      ._retrib>tbody>tr>th,._retrib>tbody>tr>td{
        vertical-align: middle;
      }
      .bcg-silver{
        color: #000;
        background: #DDDDDD;
      }
      ._tal{
        text-align: right;
      }
      ._pl0{padding-left: 0 !important}
      ._pr0{padding-right: 0 !important}
  </style>
@endsection

@section('content')

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Penjualan Ticket
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
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="box-body" style="padding: 0 15px">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Total Kunjungan</th>
                      <th>Total Pengunjung</th>
                      <th>Kendaraan</th>
                      <th>Pembayaran Offline</th>
                      <th>Pembayaran Online</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datas as $retrib)
                    <tr>
                      <td><?php echo date('d M Y', strtotime($retrib->date));?></td>
                      <td>{{$retrib->total}}</td>
                      <td>{{$retrib->ticket}}</td>
                      <td>{{$retrib->kendaraan}}</td>
                      <td>{{$retrib->offline}}</td>
                      <td>{{$retrib->online}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
  <script src="{{ asset('/min/plugins/jquery-calx/jquery-calx-2.2.7.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      $('#formId').calx();

  });
</script>

@endsection