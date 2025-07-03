<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    function index()
    {
        // return redirect(Session::get('type'));
        // dd(Session::get('type'));
        $title = 'Dashboard';
        if (Session::get('type') == 'admin') {
            //Jumlah pesanan masuk
            $masuk = Transaksi::where('status_transaksi', '=', 'paid')->count('transaksi_id');
            // dd($transaksi);
            //Total pesanan diproses
            $diproses = Transaksi::where('status_transaksi', '=', 'diproses')->count('transaksi_id');
            //Total pesanan selesai
            $selesai = Transaksi::where('status_transaksi', '=', 'selesai')->count('transaksi_id');

            $sampai = date('Y-m-d');
            $dari = date('Y-m-d', strtotime($sampai . ' - 7 days'));

            $transaksi = Transaksi::select([DB::raw('CAST(tanggal_pesan AS DATE) as tanggal'), DB::raw('count(transaksi_id) as jumlah')])->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '<=', $sampai)->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '>=', $dari)->groupBy('tanggal')->get();
            // dd($transaksi);

            return view('backend.dashboard-admin', compact('title', 'diproses', 'masuk', 'selesai', 'transaksi'));
        } else {
            return  redirect('/');
        }
    }
}
