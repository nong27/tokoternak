<?php

namespace App\Http\Controllers;

use App\Models\Detailtransaksi;
use App\Models\Notifikasi;
use App\Models\Transaksi;
use App\Models\Pengiriman;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransaksiController extends Controller
{
    protected $user;
    function __construct()
    {
        $this->user = User::where('email', Session::get('email'))->first();
    }
    function masuk()
    {
        $title = 'Order Masuk';

        $transaksi = Transaksi::where('status_transaksi', '=', 'paid')->get();
        return view('backend.order-masuk', compact('transaksi', 'title'));
    }

    function order()
    {
        $title = 'Order';

        if ($this->user->user_type == 'admin')
            $transaksi = Transaksi::get();
        else
            $transaksi = Transaksi::join('detailtransaksi', 'detailtransaksi.transaksi_id', '=', 'transaksi.transaksi_id')
                ->join('produk', 'detailtransaksi.produk_id', '=', 'produk.produk_id')
                ->where('status_transaksi', '!=', 'menunggu pembayaran')
                ->where('status_transaksi', '!=', 'verifikasi pembayaran')
                ->where('petani_id', '=', $this->user->petani->petani_id)
                ->groupBy('transaksi.transaksi_id')
                ->get();
        // dd($transaksi);
        return view('backend.order-masuk', compact('transaksi', 'title'));
    }

    function detail($id)
    {
        $title = 'Detail Order';
        $transaksi = Transaksi::find($id);
        $detail = Detailtransaksi::join('produk', 'detailtransaksi.produk_id', '=', 'produk.produk_id')
            ->where('petani_id', '=', $this->user->petani->petani_id)->where('transaksi_id', '=', $id)->get();
        $total = Detailtransaksi::join('produk', 'detailtransaksi.produk_id', '=', 'produk.produk_id')
            ->where('petani_id', '=', $this->user->petani->petani_id)->where('transaksi_id', '=', $id)->sum(DB::raw('jumlah_beli * harga'));
        return view('backend.order-detail', compact('transaksi', 'detail', 'total', 'title'));
    }
    function detailAdmin($id)
    {
        $title = 'Detail Order';
        $transaksi = Transaksi::find($id);
        $detail = $transaksi->detailtransaksi;
        // $detail = Detailtransaksi::join('produk', 'detailtransaksi.produk_id', '=', 'produk.produk_id')
        //     ->where('transaksi_id', '=', $id)->get();
        // dd($transaksi->detailtransaksi);
        $total = $transaksi->total_bayar;
        return view('backend.order-detail', compact('transaksi', 'detail', 'total', 'title'));
    }

    function tolak(Request $request)
    {
        $transaksi_id = $request->transaksi_id;
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status_transaksi = 'invalid';
        $transaksi->update();

        return back()->with('message', 'succesToast("Berhasil tolak pesanan")');
    }
    function diproses()
    {
        $title = 'Order Diproses';

        $transaksi = Transaksi::where('status_transaksi', '=', 'diproses')->orWhere('status_transaksi', '=', 'belum diterima')->get();
        // dd($transaksi);
        return view('backend.order-masuk', compact('transaksi', 'title'));
    }
    function selesai()
    {
        $title = 'Order Selesai';

        $transaksi = Transaksi::where('status_transaksi', '=', 'selesai')->get();
        return view('backend.order-masuk', compact('transaksi', 'title'));
    }

    function kirimPost(Request $request): RedirectResponse
    {
        $transaksi_id = $request->transaksi_id;
        $user = User::where('username', Session::get('email'))->first();
        $pengiriman =  Pengiriman::where('petani_id', '=', $user->petani->petani_id)
            ->where('transaksi_id', '=', $transaksi_id)
            ->first();
        // dd($pengiriman);
        $pengiriman->status_pengiriman = 'dikirim';
        $pengiriman->resi = '-';
        if ($pengiriman->estimasi != null) {
            preg_match_all('/\d+/', $pengiriman->estimasi, $matches);
            $estimasi = $matches[0];
            $est = end($estimasi) . ' day';
            $pengiriman->estimasi = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $est));
        } else
            $pengiriman->estimasi = date('Y-m-d', strtotime(date('Y-m-d') . ' +' . $request->estimasi));
        $pengiriman->update();
        return back()->with('message', 'succesToast("Berhasil proses pengiriman")');
    }
    function prosesPost(Request $request)
    {
        $transaksi_id = $request->transaksi_id;
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status_transaksi = 'diproses';
        $transaksi->read = 0;
        $transaksi->save();
        // dd($transaksi);
        $notifikasi = new Notifikasi();
        $notifikasi->fill([
            'notifikasi_judul' => 'Order Updated!',
            'notifikasi_isi' => 'Pesanan #' . $transaksi->order_id . ' anda diproses.',
            'read' => 0,
            'notifikasi_user' => $transaksi->pelanggan_id,
            'notifikasi_url' => route('order.detail', $transaksi->transaksi_id)
        ]);
        $notifikasi->save();
        return back()->with('message', 'succesAlert("Berhasil proses transaksi")');
    }
    function selesaiPost(Request $request)
    {
        $transaksi_id = $request->transaksi_id;

        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status_transaksi = 'selesai';
        $transaksi->read = 0;
        $transaksi->update();

        $notifikasi = new Notifikasi();
        $notifikasi->fill([
            'notifikasi_judul' => 'Order Updated!',
            'notifikasi_isi' => 'Pesanan #' . $transaksi->order_id . ' anda selesai.',
            'read' => 0,
            'notifikasi_user' => $transaksi->pelanggan_id,
            'notifikasi_url' => route('order.detail', $transaksi->transaksi_id)
        ]);
        $notifikasi->save();
        return back()->with('message', 'succesAlert("Berhasil proses selesai")');
    }
    function paid(Request $request)
    {
        $order_id = $request->order_id;
        $transaksi = Transaksi::where('order_id', $order_id)->first();
        $transaksi->status_transaksi = 'paid';
        $transaksi->save();

        $notifikasi = new Notifikasi();
        $notifikasi->fill([
            'notifikasi_judul' => 'New Order',
            'notifikasi_idi' => 'Pesanan baru masuk.',
            'read' => 0,
            'notifikasi_user' => 'admin',
            'notifikasi_url' => route('admin.order.masuk')
        ]);
        $notifikasi->save();

        // dd('success');
        return redirect(route('order.detail', $transaksi->transaksi_id));
    }
}
