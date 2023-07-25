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
                  <h4 class="card-title">Laporan Pinjam</h4>
                  <a href="{{url('laporan/trs/pdf?status=pinjam')}}" class="btn btn-primary"><b><i class="fa fa-download"></i> cetak</a></b></a>
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Kode
                          </th>
                          <th>
                            Buku
                          </th>
                          <th>
                            Peminjam
                          </th>
                          <th>
                            Tgl Pinjam
                          </th>
                          <th>
                            Tgl Kembali
                          </th>
                          {{-- <th>Denda</th> --}}
                          <th>
                            Status
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                          <a href="{{route('transaksi.show', $data->id)}}"> 
                            {{$data->kode_transaksi}}
                          </a>
                          </td>
                          <td>
                          
                            {{$data->buku->judul}}
                          
                          </td>

                          <td>
                            {{$data->anggota->nama}}
                          </td>
                          <td>
                           {{date('d/m/y', strtotime($data->tgl_pinjam))}}
                          </td>
                          <td>
                            {{date('d/m/y', strtotime($data->tgl_kembali))}}
                          </td>
                          <td>
                            {{ $data->status }}
                          </td>
                          </div>
                        </div>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
     </div>
    </div>
  </div>
</div>
@endsection