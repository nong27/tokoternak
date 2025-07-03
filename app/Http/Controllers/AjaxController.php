<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    function notifikasi()
    {
        $user = User::where('email', Session::get('email'))->first();
        if ($user->user_type == 'admin')
            $notifikasi = Notifikasi::where('notifikasi_user', 'admin')->where('read', 0)->get();
        else
            $notifikasi = Notifikasi::where('notifikasi_user', $user->pelanggan->pelanggan_id)->where('read', 0)->get();
        foreach ($notifikasi as $notif) {
            $notif->read = 1;
            $notif->save();
        }
        echo json_encode($notifikasi);
    }
    function orderMasuk()
    {
        $masuk = Transaksi::where('status_transaksi', '=', 'paid')->count('transaksi_id');
        echo json_encode($masuk);
    }
    function updatedTransaksi()
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $count = Transaksi::where('pelanggan_id', $pelanggan->pelanggan_id)->where('read', 0)->count();
        echo json_encode($count);
    }
}
