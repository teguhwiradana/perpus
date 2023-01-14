<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Transaksi;


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
}
