@extends('template.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $title }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('hewan.index') }}">Hewan</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <!-- Bookmark Start-->
                    <div class="bookmark">
                        <ul>
                            <li><a href="javascript:void(0)"data-bs-toggle="modal" data-bs-target="#tambah"
                                    data-original-title="Tables"><i data-feather="plus"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Bookmark Ends-->
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
                        <h5>Data Hewan</h5><span></span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="{{ asset('storage/' . $hewan->hewan_gambar) }}" alt=""
                                    class="img-thumbnail">
                            </div>
                            <div class="col-lg-9">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $hewan->hewan_nama }}</td>
                                    </tr>

                                    <tr>
                                        <th>Berat</th>
                                        <td>{{ $hewan->hewan_berat }} Kg</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>Rp{{ number_format($hewan->hewan_harga) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $hewan->hewan_deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis hewan</th>
                                        <td>{{ $hewan->jenishewan->jenishewan_nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Umur Hewan (Bulan)</th>
                                        <td>{{ $hewan->hewan_umur }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ukuran Fisik Hewan</th>
                                        <td>{{ $hewan->hewan_fisik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Warna Bulu</th>
                                        <td>{{ $hewan->hewan_warna }}</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang Tanduk (Jika ada)</th>
                                        <td>{{ $hewan->hewan_tanduk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penjual</th>
                                        <td>{{ $hewan->peternak->peternak_nama }}</td>
                                    </tr>
                                </table>
                                <div class="text-right">
                                    <a class="btn btn-primary btn-sm" href="{{ route('hewan.edit', $hewan->hewan_id) }}"><i
                                            class="icon-pencil"></i>
                                        Edit</a>
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#hapus" data-id="{{ $hewan->hewan_id }}"><i class="icon-trash"></i>
                                        Hapus</a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('hewan.index') }}"><i
                                            class="icon-angle-double-left"></i>
                                        Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Hewan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hewan.delete') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>
                            <!-- Form Name -->
                            <h6 class="m-t-10">Yakin ingin menghapus data hewan?</h6>
                            @csrf
                            <input type="hidden" name="hewan_id" value id="kodeitemhapus">

                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
@section('scripts')
    <script>
        $('#hapus').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            $(this).find('#kodeitemhapus').attr("value", kode);
        });
    </script>
    @if (Session::has('message'))
        <script>
            <?= Session::get('message') ?>
        </script>
    @endif
    @if ($errors->any())
        <script>
            dangerAlert('Terjadi Kesalahan! Periksa kembali data!')
        </script>
    @endif
@endsection
