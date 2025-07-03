@extends('template.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $title }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container invoice">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div>
                                <div class="row invo-header">
                                    <div class="col-sm-6">
                                        <div class="media">
                                            <div class="media-body m-l-20">
                                                <h4 class="media-heading f-w-600">Toko Hewan</h4>
                                                <p>hello@viho.in<br><span class="digits">289-335-6503</span></p>
                                            </div>
                                        </div>
                                        <!-- End Info-->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-md-end text-xs-center">
                                            <h3>Invoice #<span class="digits counter">{{ $transaksi->order_id }}</span></h3>
                                            <p>Tgl Transaksi: <span class="digits">
                                                    {{ date('m-d-Y H:i:s', strtotime($transaksi->tanggal_pesan)) }}</span>
                                        </div>
                                        <!-- End Title                                 -->
                                    </div>
                                </div>
                            </div>
                            <!-- End InvoiceTop-->
                            <div class="row invo-profile">
                                <div class="col-xl-4">
                                    <div class="media">
                                        <div class="media-body m-l-20">
                                            <h4 class="media-heading f-w-600">{{ $transaksi->pelanggan->nama_pelanggan }}
                                            </h4>
                                            <p>{{ $transaksi->pelanggan->user->email }}<br><span
                                                    class="digits">{{ $transaksi->pelanggan->no_telp }}</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="text-xl-end" id="project">
                                        <h6>Detail Pembelian</h6>
                                        <p>Status Transaksi <span class="digits">{{ $transaksi->status_transaksi }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Invoice Mid-->
                            <div>
                                <div class="table-responsive invoice-table" id="table">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="item">
                                                    <h6 class="p-2 mb-0">Hewan Dibeli</h6>
                                                </td>
                                                <td class="Hours">
                                                    <h6 class="p-2 mb-0">Harga Satuan</h6>
                                                </td>
                                                <td class="Rate">
                                                    <h6 class="p-2 mb-0">Jumlah</h6>
                                                </td>
                                                <td class="subtotal">
                                                    <h6 class="p-2 mb-0">Sub-total</h6>
                                                </td>
                                            </tr>
                                            @foreach ($detail as $item)
                                                <tr>
                                                    <td>
                                                        <label>{{ $item->hewan->hewan_nama }}</label>
                                                        <p class="m-0"><span>Penjual :
                                                                {{ $item->hewan->peternak->peternak_nama }}</span></p>
                                                    </td>
                                                    <td>
                                                        <p class="itemtext digits">
                                                            Rp{{ number_format($item->hewan->hewan_harga) }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="itemtext digits">{{ $item->jumlah_beli }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="itemtext digits">
                                                            Rp{{ number_format($item->harga_detail) }}</p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td>
                                                    <p class="itemtext"></p>
                                                </td>
                                                <td>
                                                    <p class="m-0">HST</p>
                                                </td>
                                                <td>
                                                    <p class="m-0 digits">13%</p>
                                                </td>
                                                <td>
                                                    <p class="m-0 digits">$419.25</p>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="Rate">
                                                    <h6 class="mb-0 p-2">Total</h6>
                                                </td>
                                                <td class="payment digits">
                                                    <h6 class="mb-0 p-2">Rp{{ number_format($transaksi->total_bayar) }}
                                                    </h6>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table-->
                            </div>
                            <!-- End InvoiceBot-->
                        </div>
                        {{-- <div class="col-sm-12 text-center mt-3">
                            <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()">Print</button>
                            <button class="btn btn-secondary" type="button">Cancel</button>
                        </div> --}}
                        @if ($transaksi->status_transaksi == 'paid')
                            <div class="col-sm-12 text-center mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#proses">Ubah Status <i data-feather="arrow-right"></i> Proses</button>
                            </div>
                        @endif
                        @if ($transaksi->status_transaksi == 'diproses')
                            <div class="col-sm-12 text-center mt-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#proses">Ubah Status <i data-feather="arrow-right"></i> Selesai</button>
                            </div>
                        @endif
                        @if ($transaksi->status_transaksi == 'selesai')
                            <div class="col-sm-12 text-center mt-3">
                                <a class="btn btn-primary" href="{{ route('invoice', $transaksi->transaksi_id) }}"><i
                                        data-feather="printer"></i> Cetak
                                    Invoice</a>
                            </div>
                        @endif
                        <!-- End Invoice-->
                        <!-- End Invoice Holder-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    @if ($transaksi->status_transaksi == 'paid')
        <div class="modal fade" id="proses" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Proses Transaksi</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.order.proses') }}" class="form-horizontal" method="POST"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            <fieldset>
                                <!-- Form Name -->
                                <h6 class="m-t-10">Proses transaksi ini ?</h6>
                                @csrf
                                <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}">

                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Proses Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if ($transaksi->status_transaksi == 'diproses')
        <div class="modal fade" id="proses" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Selesaikan Transaksi</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.order.selesai') }}" class="form-horizontal" method="POST"
                        enctype="multipart/form-data">
                        <div class="modal-body">
                            <fieldset>
                                <!-- Form Name -->
                                <h6 class="m-t-10">Selesaikan transaksi ini ?</h6>
                                @csrf
                                <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}">

                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Selesaikan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('cssplugins')
@endsection
@section('jsplugins')
@endsection
@section('scripts')
    @if ($errors->any())
        <script>
            dangerAlert('Terjadi Kesalahan! Periksa kembali data!')
        </script>
    @endif
@endsection
