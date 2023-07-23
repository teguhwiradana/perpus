<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaksi;
use Carbon\Carbon;


class TransaksiKembaliController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::user()->level == 'user')
        {
            $datas = Transaksi::where('anggota_id', Auth::user()->anggota->id)
                                ->get();
        } else {
            $datas = Transaksi::where('status','pinjam')->get();
        }
        return view('transaksi.kembali', compact(['datas']));
    }
    public function perpanjang(Request $request,$id){
        $transaksi = Transaksi::find($id);
        $transaksi->tgl_pinjam= $request->tgl_pinjam;
        $transaksi->tgl_kembali = $request->tgl_kembali;
        
        $transaksi->update();

        return redirect()->route('transaksi.kembali');
    }
    public function checktransaksi(Request $request,$id){
        $data = Transaksi::find($id);
        $hariini = \Carbon\Carbon::now()->format('Y-m-d');
        $harikembali =$data->tgl_kembali;

        $date1 = \Carbon\Carbon::parse($harikembali);
        $date2 = \Carbon\Carbon::parse($hariini);

        if ($date2 > $date1) {
            $selisih = $date2->diffInDays($date1);
            $denda = $selisih *1000;
        }
        else {
            $selisih = 0;
            $denda = 0;
        }

        return view('transaksi.check',compact('data','selisih','denda'));
    }
}
