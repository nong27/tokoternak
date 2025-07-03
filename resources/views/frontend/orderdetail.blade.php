@extends('template.front');
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Detail Order</h1>
    </div>
    <!-- Single Page Header End -->
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Order details</h1>
            <form action="{{ route('order.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                            @foreach ($peternak as $p)
                                <h5>{{ $p->peternak_nama }}</h5>
                                @if ($transaksi->status_transaksi != 'menunggu pembayaran')
                                    <span>Status Transaksi :
                                        {{ $transaksi->status_transaksi }}</span>
                                @endif
                                <span></span>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($p->detail as $r)
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ Storage::disk('public')->exists($r->hewan_gambar) ? asset('storage/' . $r->hewan_gambar) : asset('storage/produk/default.jpg') }}"
                                                            class="img-fluid me-5 rounded-circle"
                                                            style="width: 80px; height: 80px;" alt="">
                                                    </div>
                                                </th>
                                                <td>
                                                    <p class="mb-0 mt-4">{{ $r->hewan_nama }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-4">Rp{{ number_format($r->hewan_harga) }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-4">{{ $r->jumlah_beli }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 mt-4"></p>Rp{{ number_format($r->harga_detail) }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div class="table-responsive">

                            {{-- <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi->detailtransaksi as $r)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ Storage::disk('public')->exists($r->produk->gambar) ? asset('storage/' . $r->produk->gambar) : asset('storage/produk/default.jpg') }}"
                                                        class="img-fluid me-5 rounded-circle"
                                                        style="width: 80px; height: 80px;" alt="">
                                                </div>
                                            </th>
                                            <td>
                                                <p class="mb-0 mt-4">{{ $r->produk->nama_produk }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">Rp{{ number_format($r->produk->harga) }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4">{{ $r->jumlah_beli }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 mt-4"></p>Rp{{ $r->harga_detail }}</p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table> --}}
                            <table class="table">
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">Sub Total</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">
                                                Rp{{ number_format($transaksi->total_bayar) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark" id="Total">
                                                Rp{{ number_format($transaksi->total_bayar) }}
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">Status Transaksi</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark" id="Total">
                                                <b>{{ $transaksi->status_transaksi }}</b>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">


                                @if ($transaksi->status_transaksi == 'menunggu pembayaran')
                                    <div id="snap-container"></div>
                                @endif
                                @if ($transaksi->status_transaksi == 'selesai')
                                    <a href="{{ route('invoice', $transaksi->transaksi_id) }}"
                                        class="btn border btn-lg border-secondary rounded-pill px-3 text-primary">Cetak
                                        Invoice</a>
                                @endif
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <label class="form-check-label" for="Transfer-1">Pengiriman</label>
                                    <p class="text-start text-dark">Alamat Kirim : {{ $pembeli->alamat_jalan }},
                                        {{ $pembeli->lokasi_string }}</p>
                                </div>

                            </div> --}}
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    <!-- Checkout Page End -->
@endsection
@section('jsplugins')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-zn-rP3sVpOj3qa5f"></script>
@endsection
@section('scripts')
    @if ($transaksi->status_transaksi == 'menunggu pembayaran')
        <script>
            window.snap.embed('{{ $transaksi->token }}', {
                embedId: 'snap-container'
            });
            document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
                star.addEventListener('click', function() {
                    this.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 200);
                });
            });
        </script>
    @endif
@endsection
