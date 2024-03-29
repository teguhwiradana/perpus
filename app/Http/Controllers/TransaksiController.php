<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Buku;
use App\Anggota;
use App\Transaksi;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::orderBy('kode_transaksi','desc')->get();
        }
        return view('transaksi.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $getRow = Transaksi::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "TR0000".''.($lastId->id + 1);
            } else if ($lastId->id < 99) {
                    $kode = "TR000".''.($lastId->id + 1);
            } else if ($lastId->id < 999) {
                    $kode = "TR00".''.($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "TR0".''.($lastId->id + 1);
            } else {
                    $kode = "TR".''.($lastId->id + 1);
            }
        }

        $bukus = Buku::where('jumlah_buku', '>', 0)->get();
        $anggotas = Anggota::get();
        return view('transaksi.create', compact('bukus', 'kode', 'anggotas'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',
            
        ]);

        $cekJumlahPinjam = DB::table('transaksi')->select('transaksi.*')->where('transaksi.anggota_id',$request->anggota_id)->
        where('transaksi.status','pinjam')->count();
        // dd($cekJumlahPinjam);
        
        $cekBuku = DB::table('transaksi')->select('transaksi.*')->where('transaksi.buku_id',$request->buku_id)
        ->where('transaksi.anggota_id',$request->anggota_id)->
        where('transaksi.status','pinjam')->count();

        // dd($cekBuku);

        if($cekJumlahPinjam>=3){
            alert()->error('Gagal.','Batas pinjaman anda sudah limit, silahkan kembalikan buku terlebih dahulu !');
            return redirect()->route('transaksi.index');
        }
        elseif($cekBuku){
            alert()->error('Gagal.','Anda sudah meminjam buku ini, silahkan kembalikan terlebih dahulu');
            return redirect()->route('transaksi.index');
        }
        
        $transaksi = Transaksi::create([
                'kode_transaksi' => $request->get('kode_transaksi'),
                'tgl_pinjam' => $request->get('tgl_pinjam'),
                'tgl_kembali' => $request->get('tgl_kembali'),
                'buku_id' => $request->get('buku_id'),
                'anggota_id' => $request->get('anggota_id'),
                'ket' => $request->get('ket'),
                'status' => 'pinjam'
            ]);

        $transaksi->buku->where('id', $transaksi->buku_id)
                        ->update([
                            'jumlah_buku' => ($transaksi->buku->jumlah_buku - 1),
                            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('transaksi.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Transaksi::findOrFail($id);


        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }


        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Transaksi::findOrFail($id);
        $bukus = Buku::where('jumlah_buku', '>', 0)->get();
        // dd($data);

        if((Auth::user()->level == 'user') && (Auth::user()->anggota->id != $data->anggota_id)) {
                Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
                return redirect()->to('/');
        }

        return view('transaksi.edit', compact('data','bukus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $hariini = \Carbon\Carbon::now()->format('Y-m-d');
        $harikembali =$transaksi->tgl_kembali;
        
        $date1 = \Carbon\Carbon::parse($harikembali);
        $date2 = \Carbon\Carbon::parse($hariini);

        if($date2>$date1){
            $selisih = $date2->diffInDays($date1);
            $denda = $selisih *1000;
            // $dendaformat = int($denda);
            // dd($denda);

            $transaksi->update([
                        'status' => 'kembali',
                        'tgl_kembali' => \Carbon\Carbon::now(),
                        'denda' => $denda
                        ]);
        
                $transaksi->buku->where('id', $transaksi->buku->id)
                                ->update([
                                    'jumlah_buku' => ($transaksi->buku->jumlah_buku + 1),
                                    ]);
        
                alert()->success('Berhasil.','Data telah diubah!');
                return redirect()->route('transaksi.index');
        }
        else {
            $transaksi->update([
                'status' => 'kembali',
                'tgl_kembali' => \Carbon\Carbon::now(),
                'denda' => 0
                ]);

                $transaksi->buku->where('id', $transaksi->buku->id)
                                ->update([
                                    'jumlah_buku' => ($transaksi->buku->jumlah_buku + 1),
                                    ]);

                alert()->success('Berhasil.','Data telah diubah!');
                return redirect()->route('transaksi.index');
        }
    


           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('transaksi.index');
    }
}
