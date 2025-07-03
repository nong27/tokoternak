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
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Hewan</h5><span>Edit data hewan ternak.</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('hewan.update') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            <fieldset>

                                <h6 class="m-t-10">Data Hewan</h6>
                                <hr>
                                <input type="hidden" name="hewan_id" value="{{ $hewan->hewan_id }}">
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
                                                    {{ old('peternak_id', $hewan->peternak_id) == $item->peternak_id ? 'selected' : '' }}>
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
                                            class="form-control btn-square input-md"
                                            value="{{ old('hewan_nama', $hewan->hewan_nama) }}">
                                        @error('hewan_nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row mb-0">
                                    <label class="col-lg-12 form-label " for="hewan_deskripsi">Deskripsi Hewan</label>
                                    <div class="col-lg-12">
                                        <textarea class="form-control btn-square" id="hewan_deskripsi" name="hewan_deskripsi">{{ old('hewan_deskripsi', $hewan->hewan_deskripsi) }}</textarea>
                                        @error('hewan_deskripsi')
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
                                                    {{ old('jenishewan_id', $hewan->jenishewan_id) == $item->jenishewan_id ? 'selected' : '' }}>
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
                                            class="form-control btn-square input-md"
                                            value="{{ old('hewan_umur', $hewan->hewan_umur) }}">
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
                                            <option value="kurus"
                                                {{ old('hewan_fisik', $hewan->hewan_fisik) == 'kurus' ? 'selected' : '' }}>
                                                Kurus
                                            </option>
                                            <option value="gemuk"
                                                {{ old('hewan_fisik', $hewan->hewan_fisik) == 'gemuk' ? 'selected' : '' }}>
                                                Gemuk
                                            </option>
                                            <option value="ideal"
                                                {{ old('hewan_fisik', $hewan->hewan_fisik) == 'ideal' ? 'selected' : '' }}>
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
                                            class="form-control btn-square input-md"
                                            value="{{ old('hewan_warna', $hewan->hewan_warna) }}">
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
                                            <option value="panjang"
                                                {{ old('hewan_tanduk', $hewan->hewan_tanduk) == 'panjang' ? 'selected' : '' }}>
                                                Panjang
                                            </option>
                                            <option value="Pendek"
                                                {{ old('hewan_tanduk', $hewan->hewan_tanduk) == 'Pendek' ? 'selected' : '' }}>
                                                Pendek
                                            </option>
                                        </select>

                                        @error('jenishewan_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="hewan_berat">Berat Hewan (Kg)</label>
                                    <div class="col-lg-12">
                                        <input id="hewan_berat" name="hewan_berat" type="number"
                                            placeholder="Berat Hewan" class="form-control btn-square input-md"
                                            value="{{ old('hewan_berat', $hewan->hewan_berat) }}">
                                        @error('hewan_berat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <h6 class="m-t-10">Informasi Penjualan</h6>
                                <hr>
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="hewan_harga">Harga Hewan (Rp)</label>
                                    <div class="col-lg-12">
                                        <input id="hewan_harga" name="hewan_harga" type="number"
                                            placeholder="Harga Hewan" class="form-control btn-square input-md"
                                            value="{{ old('hewan_harga', $hewan->hewan_harga) }}">
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
                                            value="{{ old('hewan_jumlah', $hewan->hewan_jumlah) }}">
                                        @error('hewan_jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <img src="{{ asset('storage/' . $hewan->hewan_gambar) }}" alt=""
                                    class="img-thumbnail">
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="file">Gambar Hewan</label>
                                    <span class="small">*Biarkan kosong jika tidak ingin mengubah gambar</span>
                                    <div class="col-lg-12">
                                        <input id="file" name="file" type="file" placeholder="Harga Hewan"
                                            class="form-control btn-square input-md" value="{{ old('file') }}">
                                        @error('file')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <a class="btn btn-secondary" href="{{ route('hewan.index') }}"> <i
                                        class="icon-angle-double-left"></i>Kembali</a>
                                <button class="btn btn-primary" type="submit">Update Hewan</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
