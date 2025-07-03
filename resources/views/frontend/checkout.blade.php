@extends('template.front');
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
    </div>
    <!-- Single Page Header End -->
    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('order.place') }}" method="post">
                @csrf
                <input type="hidden" name="transaksi_id" value="{{ $transaksi->transaksi_id }}">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="table-responsive">
                            @foreach ($peternak as $p)
                                <h5>{{ $p->peternak_nama }}</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hewan</th>
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
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

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
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Checkout Page End -->
@endsection
@section('cssplugins')
    <link href="{{ asset('front') }}/css/select2.min.css" rel="stylesheet" />
@endsection
@section('jsplugins')
    <script src="{{ asset('front') }}/js/select2.min.js"></script>
@endsection
@section('scripts')
    <script>
        // $('#ongkir').on('change', function(e) {
        //     var ongkir = parseFloat($(this).val())
        //     if (ongkir != null) {
        //         $('#shipping').text('Rp' + ongkir.toLocaleString('en-US'))
        //         var total = ongkir + {{ $transaksi->total_bayar }}
        //         $('#Total').text('Rp' + total.toLocaleString('en-Us'))

        //     }
        // })
    </script>
@endsection
