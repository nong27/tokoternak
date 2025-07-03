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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Filter Tanggal</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Dari Tanggal</label>
                                    <input type="date" name="dari" id="" value="{{ $dari }}"
                                        class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="sampai" id="" value="{{ $sampai }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i
                                            data-feather="filter"></i>Filter</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Data Transaksi | {{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>OrderID</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Status</th>
                                        <th>Pelanggan</th>
                                        <th>Hewan Dibeli</th>
                                        <th>Total Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($laporan as $r)
                                        <tr>
                                            <td>{{ $r->order_id }}</td>
                                            <td>{{ date('m-d-Y H:i:s', strtotime($r->tanggal_pesan)) }}</td>
                                            <td>{{ $r->status_transaksi }} @if ($r->status_transaksi == 'belum diterima')
                                                    <span class="badge bg-danger"><i class="fa fa-exclamation"></i></span>
                                                @endif
                                            </td>
                                            <td>{{ $r->pelanggan->nama_pelanggan }}</td>
                                            <td>
                                                @foreach ($r->detailtransaksi as $item)
                                                    {{ $item->hewan->hewan_nama }};
                                                @endforeach
                                            </td>
                                            <td>Rp{{ number_format($r->total_bayar) }}</td>
                                        </tr>
                                        @php
                                            $total += $r->total_bayar;
                                        @endphp
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <h5 class="fw-bold">Total :Rp{{ number_format($total) }}</h5>

                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <form action="{{ route('admin.cetak-laporan') }}" method="get">
                                <input type="hidden" name="dari" value="{{ $dari }}">
                                <input type="hidden" name="sampai" value="{{ $sampai }}">
                                <button type="submit" class="btn btn-primary"><i data-feather="printer"></i>Cetak
                                    Laporan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('cssplugins')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/datatables.css">
@endsection
@section('jsplugins')
    <script src="{{ asset('assets') }}/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/datatable/datatables/datatable.custom.js"></script>
    <script src="{{ asset('assets') }}/js/tooltip-init.js"></script>
@endsection
@section('scripts')
    @if ($errors->any())
        <script>
            dangerAlert('Terjadi Kesalahan! Periksa kembali data!')
        </script>
    @endif
@endsection
