@extends('template.front');
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">My Orders</h1>
    </div>
    <!-- Single Page Header End -->
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Total Bayar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr>
                                <td>#{{ $item->order_id }}</td>
                                <td>{{ $item->tanggal_pesan }}</td>
                                <td>Rp{{ number_format($item->total_bayar) }}</td>
                                <td>{{ $item->status_transaksi }} @if ($item->read == 0)
                                        <span class="badge bg-secondary">Updated</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('order.detail', $item->transaksi_id) }}"
                                        class="btn border btn-sm border-secondary rounded-pill px-3 text-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
