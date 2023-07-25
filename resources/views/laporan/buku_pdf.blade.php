<!DOCTYPE html>
<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="">
	<title>Laporan Data Buku</title>
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
        hr{
            
            border: none;
            height: 2px;
            /* Set the hr color */
            color: #333; /* old IE */
            background-color: #333; /* Modern Browsers */

        }
	</style>
<h5 class="text-center">LAPORAN DATA BUKU</h5>
<h5 class="text-center">SMP NEGERI 8 MUARA JAMBI</h5>
<h5 class="text-center">TAHUN PELAJARAN 2022/2023</h5>
 <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            Judul
                          </th>
                          <th>
                            ISBN
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
                          <th>
                            Rak
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($datas as $data)
                        <tr>
                          <td class="py-1">
                            {{$data->judul}}
                          </td>
                          <td>
                          
                            {{$data->isbn}}
                          
                          </td>

                          <td>
                            {{$data->pengarang}}
                          </td>
                          <td>
                            {{$data->penerbit}}
                          </td>
                          <td>
                            {{$data->tahun_terbit}}
                          </td>
                          <td>
                            {{$data->jumlah_buku}}
                          </td>
                          <td>
                            {{$data->lokasi}}
                          </td>
                          
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
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