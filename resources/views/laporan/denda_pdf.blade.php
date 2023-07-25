<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	{{-- <style type="text/css">
		    table {
    border-spacing: 0;
    width: 100%;
    }
    th {
    background: #404853;
    background: linear-gradient(#687587, #404853);
    border:
    /* border-left: 1px solid rgba(0, 0, 0, 0.2); */
    /* border-right: 1px solid rgba(255, 255, 255, 0.1); */
    color: #000;
    padding: 8px;
    text-align: left;
    text-transform: uppercase;
    }
    /* th:first-child {
    border-top-left-radius: 4px;
    border-left: 0;
    } */
    /* th:last-child {
    border-top-right-radius: 4px;
    border-right: 0;
    } */
    td {
    border-right: 1px solid #c6c9cc;
    border-bottom: 1px solid #c6c9cc;
    padding: 8px;
    }
    td:first-child {
    border-left: 1px solid #c6c9cc;
    }
    tr:first-child td {
    border-top: 0;
    }
    tr:nth-child(even) td {
    background: #e8eae9;
    }
    tr:last-child td:first-child {
    border-bottom-left-radius: 4px;
    }
    tr:last-child td:last-child {
    border-bottom-right-radius: 4px;
    }
    img {
    	width: 40px;
    	height: 40px;
    	border-radius: 100%;
    }
    .center {
    	text-align: center;
    }
    .badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem; }
  .badge-warning {
  color: #212529;
  background-color: #ffaf00; }
  .badge-warning[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:hover, .badge-warning[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-busy:focus {
    color: #212529;
    text-decoration: none;
    background-color: #cc8c00; }

.badge-success, .preview-list .preview-item .preview-thumbnail .badge.badge-online {
  color: #fff;
  background-color: #00ce68; }
  .badge-success[href]:hover, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:hover, .badge-success[href]:focus, .preview-list .preview-item .preview-thumbnail [href].badge.badge-online:focus {
    color: #fff;
    text-decoration: none;
    background-color: #009b4e; }
	</style> --}}
  <link rel="stylesheet" href="">
	<title>Laporan Data Transaksi</title>
</head>
<body>
  <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
        .container{
            margin: 10px;
        }
        #headrapor{
            margin-left: 10px;
        }
        #headrapor p{
            margin-bottom: 1px;
            font-size: 10pt
        }
        .header img{
            margin: 10px;
        
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .signature {
            text-align: center;
            margin-top: 50px;
            width: 48%;
            border-top: 1px solid #000;
            padding-top: 15px;
        }
        hr{
            
            border: none;
            height: 2px;
            /* Set the hr color */
            color: #333; /* old IE */
            background-color: #333; /* Modern Browsers */

        }
	</style>
<h5 class="text-center">LAPORAN DATA TRANSAKSI PERPUSTAKAAN</h5>
<h5 class="text-center">SMP NEGERI 8 MUARA JAMBI</h5>
<h5 class="text-center">TAHUN PELAJARAN 2022/2023</h5>
<hr>
                  <table class="table table-bordered">
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
                          <th>
                            denda
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                       <tr>
                          <td class="py-1">
                            {{$data->kode_transaksi}}
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
                              {{ $data->denda }}
                        </tr>
                      @endforeach
                      
                      <tr>
                        <td colspan="5" class="text-center">Total</td>
                        <td>{{ ($data->sum('denda')) }}</td>
                      </tr>
                      </tbody>
                    </table>
                    <br><br><br>

    <?php
        function tgl_indo($tanggal){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);
            
            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun
        
            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
        }
    ?>

    <div class="row">
      <div class="col-md-6">
        <p align="left" style="margin-left: 30px" id="tanggal" class="mb-0">Kasang Pudak, {{tgl_indo(date('Y-m-d')) }}</p>
        <p align="left" class="mt-0" style="margin-left: 30px">Mengetahui,</p>
        <p align="left" style="margin-bottom: 4em;margin-left:30px ;">Kepala Perpustakaan</p>
        <p align="left" style="margin-left: 30px; margin-top:0">NIP:</p>
      </div>
      <div class="col-md-6">
        <p align="left" style="margin-left: 470px" id="tanggal" class="mb-0">Kasang Pudak, {{tgl_indo(date('Y-m-d')) }}</p>
        <p align="left" class="mt-0" style="margin-left: 470px">Mengetahui,</p>
        <p align="left" class="mt-0" style="margin-bottom: 4em;margin-left: 470px">Kepala Sekolah </p>
        <p align="left" class="mt-0" style="margin-left: 470px">NIP:</p>
      </div>
    </div>
</body>
</html>