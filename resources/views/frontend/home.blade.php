@extends('template.front');
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">Dipelihara oleh peternak terpercaya</h4>
                    <h1 class="mb-5 display-3 text-primary">Ternak Terbaik</h1>
                    <div class="position-relative mx-auto">
                        <form action="" method="get">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text"
                                placeholder="Search" name="keyword">
                            <button type="submit"
                                class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                                style="top: 0; right: 25%;">Submit Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('front') }}/img/hero-img-1.jpg"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                {{-- <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a> --}}
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('front') }}/img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                {{-- <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a> --}}
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            @isset($keyword)
                @if ($keyword != '')
                    <h5>Search : "{{ $keyword }}"</h5>
                @endif
            @endisset
            <h1 class="mb-4">Ternak shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3 mb-4">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6">

                        </div>
                        <div class="col-xl-3">
                            {{-- <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <form action="" method="get">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Jenis Hewan</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <input type="hidden" name="keyword" value="{{ $keyword }}">
                                                @foreach ($jenishewan as $jenis)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <div class="form-check ps-0 m-0 category-list-box">
                                                                <input class="checkbox_animated" name="jenishewan[]"
                                                                    type="checkbox" id="fruit"
                                                                    value="{{ $jenis->jenishewan_id }}"
                                                                    @if (in_array($jenis->jenishewan_id, $jenishewanGet)) checked @endif>
                                                                <label class="form-check-label" for="fruit">
                                                                    <span
                                                                        class="name">{{ $jenis->jenishewan_nama }}</span>
                                                                    <span
                                                                        class="number">({{ $jenis->hewan->where('hewan_jumlah', '>', 0)->count() }})</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <h4>Umur Hewan (Bulan)</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <div class="form-check w-100 ps-0 m-0 category-list-box">
                                                            <label for="">Umur minimal</label>
                                                            <input type="number" value="{{ $umurmin }}" name="umurmin"
                                                                id="" class="form-control">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <div class="form-check w-100 ps-0 m-0 category-list-box">
                                                            <label for="">Umur maksimal</label>
                                                            <input type="number" name="umurmax" value="{{ $umurmax }}"
                                                                id="" class="form-control">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn border border-secondary rounded-pill px-3 text-primary">Filter</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach ($hewan as $r)
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">

                                                <img src="{{ Storage::disk('public')->exists($r->hewan_gambar) ? asset('storage/' . $r->hewan_gambar) : asset('storage/hewan/default.jpg') }}"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">{{ $r->peternak->peternak_nama }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $r->hewan_nama }}</h4>
                                                <p>{{ substr(strip_tags(preg_replace('/<img[^>]+\>/i', '', $r->hewan_deskripsi)), 0, 100) }}...
                                                </p>
                                                <p><b>Jumlah dijual : </b>{{ $r->hewan_jumlah }} Ekor</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rp
                                                        {{ number_format($r->hewan_harga) }} /
                                                        {{ $r->ekor }}</p>

                                                    <a href="#" id="add" data-bs-toggle="modal"
                                                        data-bs-target="#order" data-id="{{ $r->hewan_id }}"
                                                        data-nama="{{ $r->hewan_nama }}"
                                                        data-deskripsi="{{ $r->hewan_deskripsi }}"
                                                        data-berat="{{ $r->hewan_berat }}"
                                                        data-umur="{{ $r->hewan_umur }}"
                                                        data-fisik="{{ $r->hewan_fisik }}"
                                                        data-warna="{{ $r->hewan_warna }}"
                                                        data-tanduk="{{ $r->hewan_tanduk }}"
                                                        data-gambar="{{ $r->hewan_gambar }}"
                                                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                            class="fa fa-shopping-bag me-2 text-primary"></i> Pesan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        {{ $hewan->appends(request()->query())->links('vendor.pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
    <div class="modal fade" id="order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <form action="{{ route('order') }}" method="post">
                        @csrf
                        @if (Session::get('type') == 'pelanggan')
                            <img alt="Gambar Hewan" id="gambar" class="img-thumbnail">
                            <input type="hidden" name="hewan_id" id="kode" value>
                            <h6 for="">Deskripsi</h6>
                            <div class="mb-2" id="deskripsi">

                            </div>
                            <h6 for="">Ciri</h6>
                            <div class="mb-2">
                                <label for="">Berat: </label>
                                <span class="fw-bold" id="Berat"></span>Kg <br>
                                <label for="">Umur: </label>
                                <span class="fw-bold" id="Umur"></span> bulan <br>
                                <label for="">Ukuran Fisik: </label>
                                <span class="fw-bold" id="Fisik"></span> <br>
                                <label for="">Warna Bulu: </label>
                                <span class="fw-bold" id="Warna"></span> <br>
                                <label for="">Ukuran Tanduk: </label>
                                <span class="fw-bold" id="Tanduk"></span> <br>
                            </div>
                            <div class="row">
                                <div class="input-group w-100 mx-auto d-flex col">
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button onclick="$('#qty').val($('#qty').val()--)" type="button"
                                                class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="jumlah_beli" id="qty"
                                            class="form-control text-center border-0" value="1">
                                        <div class="input-group-btn">
                                            <button type="button" onclick="$('#qty').val($('#qty').val()++)"
                                                class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit"
                                    class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Pesan</button>
                            </div>
                        @else
                            <div class="text-center">
                                <a href="{{ route('login') }}"
                                    class="btn border border-secondary rounded-pill px-3 text-primary"> Login Untuk
                                    Memesan</a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#order').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            var nama = $(event.relatedTarget).data('nama');
            var deskripsi = $(event.relatedTarget).data('deskripsi');
            var berat = $(event.relatedTarget).data('berat');
            var umur = $(event.relatedTarget).data('umur');
            var fisik = $(event.relatedTarget).data('fisik');
            var warna = $(event.relatedTarget).data('warna');
            var tanduk = $(event.relatedTarget).data('tanduk');
            var gambar = $(event.relatedTarget).data('gambar');
            var src = "{{ asset('storage') }}" + '/' + gambar;

            $(this).find('#kode').attr("value", kode);
            $(this).find('#modalLabel').text(nama);
            $(this).find('#deskripsi').text(deskripsi);
            $(this).find('#Berat').text(berat);
            $(this).find('#Umur').text(umur);
            $(this).find('#Fisik').text(fisik);
            $(this).find('#Warna').text(warna);
            $(this).find('#Tanduk').text(tanduk);
            $(this).find('#gambar').attr("src", src);
        });
    </script>
@endsection
