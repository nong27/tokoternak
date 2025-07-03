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
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Penjual</th>
                                        <th>Jenis Hewan</th>
                                        <th>Nama Hewan</th>
                                        <th>Berat</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($hewan as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->peternak->peternak_nama }}</td>
                                            <td>{{ $row->jenishewan->jenishewan_nama }}</td>
                                            <td>{{ $row->hewan_nama }}</td>
                                            <td>{{ $row->hewan_berat }}</td>
                                            <td>Rp{{ number_format($row->hewan_harga) }}</td>
                                            <td>{{ $row->hewan_jumlah }}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('hewan.detail', $row->hewan_id) }}"><i
                                                        class="icon-eye"></i>
                                                    Detail</a>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('hewan.edit', $row->hewan_id) }}"><i
                                                        class="icon-pencil"></i>
                                                    Edit</a>
                                                <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                                    data-bs-toggle="modal" data-bs-target="#hapus"
                                                    data-id="{{ $row->hewan_id }}"><i class="icon-trash"></i>
                                                    Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="tambah" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Hewan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('hewan.insert') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>

                            <!-- Form Name -->
                            <h6 class="m-t-10">Data Hewan</h6>
                            <hr>
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Select Basic -->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="selectbasic">Penjual</label>
                                <div class="col-lg-12">
                                    <select id="selectbasic" name="peternak_id" class="form-select btn-square">
                                        <option value="" label="">Pilih Penjual</option>
                                        @foreach ($peternak as $item)
                                            <option value="{{ $item->peternak_id }}"
                                                {{ old('peternak_id') == $item->peternak_id ? 'selected' : '' }}>
                                                {{ $item->peternak_nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('peternak_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_nama">Nama Hewan Ternak</label>
                                <div class="col-lg-12">
                                    <input id="hewan_nama" name="hewan_nama" type="text" placeholder=" Hewan"
                                        class="form-control btn-square input-md" value="{{ old('hewan_nama') }}">
                                    @error('hewan_nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 row mb-0">
                                <label class="col-lg-12 form-label " for="hewan_deskripsi">Deskripsi Hewan</label>
                                <div class="col-lg-12">
                                    <textarea class="form-control btn-square" id="hewan_deskripsi" name="hewan_deskripsi">{{ old('hewan_deskripsi') }}</textarea>
                                    @error('hewan_deskripsi')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_berat">Berat Hewan (Kg)</label>
                                <div class="col-lg-12">
                                    <input id="hewan_berat" name="hewan_berat" type="number" placeholder="Berat Hewan"
                                        class="form-control btn-square input-md" value="{{ old('hewan_berat') }}">
                                    @error('hewan_berat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <h6 class="m-t-10">Ciri Hewan</h6>
                            <hr>
                            <!-- Select Basic -->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="selectbasic">Jenis Hewan</label>
                                <div class="col-lg-12">
                                    <select id="selectbasic" name="jenishewan_id" class="form-select btn-square">
                                        <option value="" label="">Pilih Jenis Hewan</option>
                                        @foreach ($jenishewan as $item)
                                            <option value="{{ $item->jenishewan_id }}"
                                                {{ old('jenishewan_id') == $item->jenishewan_id ? 'selected' : '' }}>
                                                {{ $item->jenishewan_nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('jenishewan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_umur">Umur Hewan (Bulan)</label>
                                <div class="col-lg-12">
                                    <input id="hewan_umur" name="hewan_umur" type="number" placeholder="Usia Hewan"
                                        class="form-control btn-square input-md" value="{{ old('hewan_umur') }}">
                                    @error('hewan_umur')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="selectbasic">Ciri Fisik Hewan</label>
                                <div class="col-lg-12">
                                    <select id="selectbasic" name="hewan_fisik" class="form-select btn-square">
                                        <option value="" label="">Pilih Ciri Fisik Hewan</option>
                                        <option value="kurus" {{ old('hewan_fisik') == 'kurus' ? 'selected' : '' }}>
                                            Kurus
                                        </option>
                                        <option value="gemuk" {{ old('hewan_fisik') == 'gemuk' ? 'selected' : '' }}>
                                            Gemuk
                                        </option>
                                        <option value="ideal" {{ old('hewan_fisik') == 'ideal' ? 'selected' : '' }}>
                                            Ideal
                                        </option>
                                    </select>

                                    @error('jenishewan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_warna">Warna Bulu</label>
                                <div class="col-lg-12">
                                    <input id="hewan_warna" name="hewan_warna" type="text" placeholder="Warna Bulu"
                                        class="form-control btn-square input-md" value="{{ old('hewan_warna') }}">
                                    @error('hewan_warna')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="selectbasic">Ukuran Tanduk (Untuk
                                    Sapi/Kerbau)</label>
                                <div class="col-lg-12">
                                    <select id="selectbasic" name="hewan_tanduk" class="form-select btn-square">
                                        <option value="" label="">Hewan tidak bertanduk</option>
                                        <option value="panjang" {{ old('hewan_tanduk') == 'panjang' ? 'selected' : '' }}>
                                            Panjang
                                        </option>
                                        <option value="Pendek" {{ old('hewan_tanduk') == 'Pendek' ? 'selected' : '' }}>
                                            Pendek
                                        </option>
                                    </select>

                                    @error('jenishewan_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <h6 class="m-t-10">Informasi Hewan Lainnya</h6>
                            <hr>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_harga">Harga Hewan (Rp)</label>
                                <div class="col-lg-12">
                                    <input id="hewan_harga" name="hewan_harga" type="number" placeholder="Harga Hewan"
                                        class="form-control btn-square input-md" value="{{ old('hewan_harga') }}">
                                    @error('hewan_harga')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="hewan_jumlah">Jumlah Hewan</label>
                                <div class="col-lg-12">
                                    <input id="hewan_jumlah" name="hewan_jumlah" type="number"
                                        placeholder="Harga Hewan" class="form-control btn-square input-md"
                                        value="{{ old('hewan_jumlah') }}">
                                    @error('hewan_jumlah')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="file">Gambar Hewan</label>
                                <div class="col-lg-12">
                                    <input id="file" name="file" type="file" placeholder="Harga Hewan"
                                        class="form-control btn-square input-md" value="{{ old('file') }}">
                                    @error('file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Tambah Hewan</button>
                    </div>
                </form>
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
