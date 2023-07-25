@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Laporan Buku</h4>

  <div class="col-md-2 pull-left">
    <a href="{{ url('laporan/buku/pdf') }}" class="btn btn-primary btn-rounded btn-fw"><b><i class="fa fa-download"></i> cetak</a></b>
  </div>
  <!-- <div class="col-md-2 pull-left">
     <a href="{{ url('laporan/buku/excel') }}" class="btn btn-success btn-rounded btn-fw">
     <b><i class="fa fa-download"></i> Export EXCEL</a></b>
  </div> -->
      <table class="table table-bordered" >
        <thead>
          <tr>
            <th>
              ISBN
            </th>
            <th>
              judul
            </th>
            <th>
              Pengarang
            </th>
            <th>
              Penerbit
            </th>
            <th>
              Tahun
            </th>
            <th>
              Stok
            </th>
          </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
          <tr>
            <td>
              {{$data->isbn}}
            </td>
            <td>
              {{$data->judul}}
            </td>
            </td>
            <td>
              {{$data->pengarang}}
            </td>
            <td>
              {{ $data->penerbit }}
            </td>
            <td>
              {{$data->tahun_terbit}}
            </td>
            <td>
              {{$data->jumlah_buku}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
@endsection