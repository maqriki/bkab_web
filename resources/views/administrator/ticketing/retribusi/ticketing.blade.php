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
        Penjualan Ticket
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
              
              <form class="form-horizontal" id="formId" method="POST" action="{{ url('a/admin/ticketing/penjualan-store', $data->lokasi_id) }}">
                {{ csrf_field() }}
                <input type="text" name="lokasi" style="display: none;" value="{{$data->lokasi_name}}">
                <div class="box-body" style="padding: 0 15px">
                  <h3>Penjualan</h3>
                  <hr>
                  <input type="text" name="nama" style="display: none;" value="{{$data->lokasi_name}}">
                  <input type="text" name="lokasiId" style="display: none;" value="{{$data->lokasi_id}}">
                  <div class="row no-margin" style="padding-bottom: 3em">
                    <div class="col-md-6">
                      <h3><center>Retribusi</center></h3>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th colspan="2" style="height: 60px"></th>
                          </tr>
                          <tr>
                            <th colspan="2" class="bcg-silver">Pengunjung</th>
                          </tr>
                          <tr>
                            <th>Dewasa</th>
                            <td>
                              <input data-cell="D1" type="number" min="1" name="tD" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                          <tr>
                            <th>Anak</th>
                            <td>
                              <input data-cell="BB4" type="number" min="1" name="tA" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                          <tr>
                            <th colspan="2" class="bcg-silver">Kendaraan</th>
                          </tr>
                          <tr>
                            <th>Bus Besar</th>
                            <td>
                              <input data-cell="BB1" type="number" min="1" name="tBB" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                          <tr>
                            <th>Bus</th>
                            <td>
                              <input data-cell="B1" type="number" min="1" name="tB" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                          <tr>
                            <th>Mobil</th>
                            <td>
                              <input data-cell="MB1" type="number" min="1" name="tMB" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                          <tr>
                            <th>Motor</th>
                            <td>
                              <input data-cell="MT1" type="number" min="1" name="tM" class="form-control" placeholder="jumlah">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-6" style="border-left: 1px solid #000">
                      <h3><center>{{$data->lokasi_name}}</center></h3>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Operator : {{ Auth::user()->name }}</th>
                            <th style="text-align: right;">Tanggal : <?php echo date("d M Y"); ?></th>
                          </tr>
                        </thead>
                      </table>
                      <table class="table _retrib">
                        <tr>
                          <th colspan="5" class="bcg-silver">Pengunjung</th>
                        </tr>
                        <tr>
                          <th>Dewasa</th>
                          <td width="15%" class="_pr0">
                            <input data-cell="D2" data-formula="D1*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_dewasa, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T1" data-formula="D2*{{$retribusi->harga_dewasa}}" type="number" class="form-control no-border" name="rD">
                          </td>
                        </tr>
                        <tr>
                          <th>Anak</th>
                          <td width="15%" class="_pr0">
                             <input data-cell="BB5" data-formula="BB4*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_anak, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T2" type="number" data-formula="BB5*{{$retribusi->harga_anak}}" class="form-control no-border" name="rA">
                          </td>
                        </tr>
                        <tr>
                          <th colspan="5" class="bcg-silver">Kendaraan</th>
                        </tr>
                        <tr>
                          <th>Bus Besar</th>
                          <td width="15%" class="_pr0">
                            <input data-cell="BB2" data-formula="BB1*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_bus_besar, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T3" data-formula="BB2*{{$retribusi->harga_bus_besar}}" type="number" class="form-control no-border" name="rBB">
                          </td>
                        </tr>
                        <tr>
                          <th>Bus</th>
                          <td width="15%" class="_pr0">
                            <input data-cell="B2" data-formula="B1*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_bus_kecil, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T4" data-formula="B2*{{$retribusi->harga_bus_kecil}}" type="number" class="form-control no-border" name="rB">
                          </td>
                        </tr>
                        <tr>
                          <th>Mobil</th>
                          <td width="15%" class="_pr0">
                            <input data-cell="MB2" data-formula="MB1*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_mobil, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T5" data-formula="MB2*{{$retribusi->harga_mobil}}" type="number" class="form-control no-border" name="rMB">
                          </td>
                        </tr>
                        <tr>
                          <th>Motor</th>
                          <td width="15%" class="_pr0">
                            <input data-cell="MT2" data-formula="MT1*1" type="number" class="form-control no-border _tal" name="">
                          </td>
                          <td class="_pl0"><b>X</b> Rp.{{ number_format($retribusi->harga_motor, 2) }}</td>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-cell="T6" data-formula="MT2*{{$retribusi->harga_motor}}" type="number" class="form-control no-border" name="rM">
                          </td>
                        </tr>
                        <tr>
                          <th colspan="5" class="bcg-silver"></th>
                        </tr>
                        <tr>
                          <th colspan="3">Total</th>
                          <td width="30px">Rp.</td>
                          <td width="30%">
                            <input data-formula="SUM(T1:T6)" type="number" required="" class="form-control no-border" name="rTotal">
                          </td>
                        </tr>
                      </table>
                      <div class="col-lg-11">
                        <button type="submit" class="btn bg-deep-purple own-btn"><i class="fa fa-check"></i> Submit</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="box-footer" style="padding: 15px">                  
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
  <script src="{{ asset('/min/plugins/jquery-calx/jquery-calx-2.2.7.min.js') }}"></script>
  <script type="text/javascript">
    $(function () {
      $('#formId').calx();

  });
</script>

@endsection