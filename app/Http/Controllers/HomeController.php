<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Detailpembelian;
use App\Models\Detailtransaksi;
use App\Models\Hewan;
use App\Models\Jenishewan;
use App\Models\Lokasitoko;
use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Pembeli;
use App\Models\Pembelian;
use App\Models\Pengiriman;
use App\Models\Province;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $jenishewanGet = $request->jenishewan;
        $keyword = $request->keyword;
        $umurmin = $request->umurmin;
        $umurmax = $request->umurmax;

        if ($keyword == null)
            $keyword = '';
        if ($umurmin == null)
            $umurmin = '';
        if ($umurmax == null)
            $umurmax = '';
        if ($jenishewanGet == null)
            $jenishewanGet = [];
        $title = 'Home Page';
        $model = new Hewan();
        if ($jenishewanGet != null) {
            $model = $model->whereIn('jenishewan_id', $jenishewanGet);
        }
        if ($umurmin != '') {
            $model = $model->where('hewan_umur', '>=', $umurmin);
        }
        if ($umurmax != '') {
            $model = $model->where('hewan_umur', '<=', $umurmax);
        }
        $model = $model->where('hewan_nama', 'like', '%' . $keyword . '%');
        $model = $model->with('peternak');
        $hewan = $model = $model->where('hewan_jumlah', '>', '0')->paginate(12);
        // dd($hewan);
        $jenishewan = Jenishewan::all();
        return view('frontend.home', compact('title', 'hewan', 'jenishewan', 'jenishewanGet', 'keyword', 'umurmin', 'umurmax'));
    }

    function search(Request $request)
    {
        $title = 'Search';
        $keyword = $request->keyword;
        $hewan = Hewan::where('hewan_nama', 'LIKE', "%{$keyword}%")->orderBy('hewan_id', 'desc')->paginate(12);
        return view('frontend.home', compact('title', 'hewan', 'keyword'));
    }

    function orderPost(Request $request): RedirectResponse
    {
        // $cart =
        //Validasi
        $validated = $request->validate([
            'hewan_id' => 'required',
            'jumlah_beli' => 'required',
            'hewan_id' =>  'required'
        ]);

        //Cek Stok
        if (!Hewan::where('hewan_id', "=", $validated['hewan_id'])->where('hewan_jumlah', '>=', $validated['jumlah_beli'])->exists()) {
            return back()->with('message', "dangerToast('Pesanan tidak boleh melebihi stok');");
        }

        $hewan = Hewan::find($validated['hewan_id']);
        // $hewan->decrement('stok', $validated['jumlah_beli']);
        // Petani::insert($validated);

        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();

        $totalbayar = $hewan->hewan_harga * $validated['jumlah_beli'];
        $data['pelanggan_id'] = $pelanggan->pelanggan_id;

        $transaksi = Transaksi::where('pelanggan_id', '=', $data['pelanggan_id'])->where('status_transaksi', '=', 'in cart')->first();

        if ($transaksi) {
            $transaksi->increment('total_bayar', $totalbayar);
            $transaksi->update($data);
        } else {
            $data['status_transaksi'] = 'in cart';
            $data['total_bayar'] = $totalbayar;
            $transaksi = new Transaksi();
            $transaksi->fill($data);
            $transaksi->save();
        }
        $validated['transaksi_id'] = $transaksi->transaksi_id;
        $validated['harga_detail'] = $totalbayar;
        Detailtransaksi::insert($validated);

        return back();
    }

    function cart()
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::where('pelanggan_id', '=', $pelanggan->pelanggan_id)->where('status_transaksi', '=', 'in cart')->first();
        if ($transaksi != null) {
            $detail = Detailtransaksi::join('hewan', 'hewan.hewan_id', '=', 'detailtransaksi.hewan_id')->where('transaksi_id', '=', $transaksi->transaksi_id)->get();
            if ($detail == null)
                $transaksi->destroy();
        } else
            $detail = null;
        // dd($pelanggan);

        return view('frontend.cart', compact('transaksi', 'detail'));
    }
    function deleteCart(Request $request): RedirectResponse
    {

        $detailtransaksi_id  = $request->detailtransaksi_id;
        $datadetail = Detailtransaksi::find($detailtransaksi_id);

        Transaksi::where('transaksi_id', $datadetail->transaksi_id)->decrement('total_bayar', $datadetail->harga_detail);
        Detailtransaksi::destroy($detailtransaksi_id);
        return back();
    }
    function checkout($transaksi_id)
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::find($transaksi_id);

        //Pisahkan Petani
        $peternak = DB::table('detailtransaksi')
            ->join('hewan', 'detailtransaksi.hewan_id', '=', 'hewan.hewan_id')
            ->join('peternak', 'hewan.peternak_id', '=', 'peternak.peternak_id')
            ->where('detailtransaksi.transaksi_id', '=', $transaksi_id)->groupBy('hewan.peternak_id')->get();
        // dd($peternak);
        foreach ($peternak as $key => $p) {
            $detail = Detailtransaksi::join('hewan', 'detailtransaksi.hewan_id', '=', 'hewan.hewan_id')->where('peternak_id', $p->peternak_id)->where('detailtransaksi.transaksi_id', '=', $transaksi_id)->groupBy('hewan.peternak_id')->get();
            $peternak[$key]->detail = $detail;
        }
        // $peternak = Petani::whereIn('')
        // $detail = Detailtransaksi::where('transaksi_id', '=', $transaksi_id)->join('hewan', 'detailtransaksi.hewan_id', '=', 'hewan.hewan_id')->groupBy('peternak_id')->get();
        $sumBerat = Detailtransaksi::sum('jumlah_beli');

        $destination = $pelanggan->lokasi_id;


        return view('frontend.checkout', compact('transaksi', 'pelanggan', 'peternak'));
    }

    function placeOrder(Request $request): RedirectResponse
    {

        $transaksi_id = $request->transaksi_id;
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status_transaksi = 'menunggu pembayaran';
        // $now = date('Y-m-d H:i:s');
        // $batas = strtotime($now . ' +1 day');
        // $transaksi->batas_bayar = $batas;
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();

        \Midtrans\Config::$serverKey = 'SB-Mid-server-y0kYrE2DPn-tpSxXDXiWIyQh';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order_id = rand();
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $transaksi->total_bayar,
            ),
            'customer_details' => array(
                'first_name' => $pelanggan->nama_pelanggan,
                'email' => $pelanggan->user->email,
                'phone' => $pelanggan->no_telp,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $datatrx['token'] = $snapToken;
        $datatrx['order_id'] = $order_id;

        $transaksi->fill($datatrx);
        $transaksi->save();
        $transaksi->save();

        foreach ($transaksi->detailtransaksi as $key => $detail) {
            $hewan = Hewan::find($detail->hewan_id);
            $hewan->decrement('hewan_jumlah', $detail->jumlah_beli);
        }

        return redirect(route('order.detail', $transaksi_id));
    }

    function detail($transaksi_id)
    {
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::find($transaksi_id);

        //Pisahkan Petani
        $peternak = Detailtransaksi::join('hewan', 'detailtransaksi.hewan_id', '=', 'hewan.hewan_id')
            ->join('peternak', 'hewan.peternak_id', '=', 'peternak.peternak_id')
            ->where('detailtransaksi.transaksi_id', '=', $transaksi_id)->groupBy('hewan.peternak_id')->get();
        // dd($peternak);
        foreach ($peternak as $key => $p) {
            $detail = Detailtransaksi::join('hewan', 'detailtransaksi.hewan_id', '=', 'hewan.hewan_id')->where('peternak_id', $p->peternak_id)->where('detailtransaksi.transaksi_id', '=', $transaksi_id)->groupBy('hewan.peternak_id')->get();
            $peternak[$key]->detail = $detail;
        }
        // $transaksi = Transaksi::find($transaksi_id);
        // $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();

        if ($transaksi->status_transaksi == 'in cart')
            return redirect(route('cart'));
        // $detail = $transaksi

        return view('frontend.orderdetail', compact('transaksi', 'pelanggan',  'peternak'));
    }

    // function uploadBukti(Request $request)
    // {
    //     $pembelian_id = $request->pembelian_id;
    //     $pembelian = Pembelian::find($pembelian_id);
    //     $path = $request->file('bukti')->storePublicly('bukti', 'public');
    //     $data = [
    //         'pembelian_id' => $pembelian_id,
    //         'metode_bayar' => 'transfer',
    //         'jumlah_bayar' => $pembelian->jumlah_bayar + $pembelian->ongkir,
    //         'bukti_bayar' => $path,
    //     ];
    //     $pembayaran = Pembayaran::where('pembelian_id', '=', $pembelian_id)->first();
    //     if ($pembayaran == null) {
    //         $pembayaran = new Pembayaran();
    //         $pembayaran->fill($data);
    //         $pembayaran->save();
    //     } else {
    //         $pembayaran->update($data);
    //     }
    //     $pembelian->status_pembelian = 'verifikasi pembayaran';
    //     $pembelian->save();
    //     return back()->with('message', "successToast('pembayaran diterima, menunggu verifikasi')");
    // }

    function orderList()
    {

        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        $transaksi = Transaksi::where('pelanggan_id', $pelanggan->pelanggan_id)->orderBy('tanggal_pesan', 'desc')->get();
        Transaksi::where('pelanggan_id', $pelanggan->pelanggan_id)->where('read', 0)->update(['read' => 1]);
        return view('frontend.order-list', compact('transaksi', 'pelanggan'));
    }
    function profil()
    {
        $title = 'Profil';
        $user = User::find(Session::get('user_id'));
        // dd($user);
        return view('frontend.profil', compact('user', 'title'));
    }
    function editProfil()
    {
        $title = 'Edit Profil';
        $user = User::find(Session::get('user_id'));
        $pelanggan = Pelanggan::where('user_id', '=', Session::get('user_id'))->first();
        return view('frontend.profil-edit', compact('user', 'title', 'pelanggan'));
    }
}
