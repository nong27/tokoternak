<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    function invoice($transaksi_id)
    {

        $transaksi = Transaksi::find($transaksi_id);

        $pdf =  Pdf::setOption(['isRemoteEnabled' => true]);
        $pdf->loadView('invoice', compact('transaksi'));

        return $pdf->download('invoice-test.pdf');
    }

    function transaksi(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $title = 'Laporan';

        // dd($dari);

        $model = Transaksi::select('*');
        if ($dari != null)
            $model->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '>=', $dari);
        if ($sampai != null)
            $model->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '<=', $sampai);
        $model->where('status_transaksi', '<>', 'menunggu pembayaran');
        $laporan = $model->get();


        return view('backend.laporan_pembelian', compact('laporan', 'dari', 'sampai', 'title'));
    }
    function cetak(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        // dd($dari);

        $model = Transaksi::select('*');
        if ($dari != null)
            $model->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '>=', $dari);
        if ($sampai != null)
            $model->where(DB::raw('CAST(tanggal_pesan AS DATE)'), '<=', $sampai);
        $model->where('status_transaksi', '<>', 'menunggu pembayaran');
        $laporan = $model->get();

        $data = [
            'title' => 'Laporan Transaksi',
            'tanggal' => date('Y-m-d'),
            'laporan' => $laporan,
            'dari' => $dari,
            'sampai' => $sampai
        ];
        $pdf =  Pdf::setOption(['isRemoteEnabled' => true]);
        $pdf->loadView('backend.laporan_pdf', $data);

        return $pdf->download('laporan-pembelian.pdf');
    }
}
