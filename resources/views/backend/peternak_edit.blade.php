@extends('template.' . Session::get('type'))
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $title }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('peternak.index') }}">Peternak</a></li>
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
                        <h5>Form Peternak</h5><span>Edit data diri dan akun petani.</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('peternak.update') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            <fieldset>

                                <!-- Form Name -->
                                <h6 class="m-t-10">Identitas Peternak</h6>
                                <hr>
                                @csrf
                                <input type="hidden" name="peternak_id" value="{{ $peternak->peternak_id }}">
                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="peternak_nama">Nama Lengkap</label>
                                    <div class="col-lg-12">
                                        <input id="peternak_nama" name="peternak_nama" type="text"
                                            placeholder="Nama Lengkap" class="form-control btn-square input-md"
                                            value="{{ old('peternak_nama', $peternak->peternak_nama) }}">
                                        @error('peternak_nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Select Basic -->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="selectbasic">Jenis Kelamin</label>
                                    <div class="col-lg-12">
                                        <select id="selectbasic" name="peternak_jk" class="form-select btn-square">
                                            <option value="" label=""></option>
                                            <option value="L"
                                                {{ old('peternak_jk', $peternak->peternak_jk) == 'L' ? 'selected' : '' }}>
                                                Laki-Laki
                                            </option>
                                            <option value="P"
                                                {{ old('peternak_jk', $peternak->peternak_jk) == 'P' ? 'selected' : '' }}>
                                                Perempuan
                                            </option>
                                        </select>

                                        @error('peternak_jk')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="peternak_hp">No HP</label>
                                    <div class="col-lg-12">
                                        <input id="peternak_hp" value="{{ old('peternak_hp', $peternak->peternak_hp) }}"
                                            name="peternak_hp" type="text" placeholder="No HP"
                                            class="form-control btn-square input-md">
                                        @error('peternak_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="mb-3 row mb-0">
                                    <label class="col-lg-12 form-label " for="peternak_alamat">Alamat Peternak</label>
                                    <div class="col-lg-12">
                                        <textarea class="form-control btn-square" id="peternak_alamat" name="peternak_alamat">{{ old('peternak_alamat', $peternak->peternak_alamat) }}</textarea>
                                        @error('peternak_alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @if (Session::get('type') == 'admin')
                                    <div class="mb-3 row mb-0">
                                        <label class="col-lg-12 form-label " for="kecamatan_id">Kecamatan</label>
                                        <select id="selectbasic" name="kecamatan_id" class="form-select btn-square">
                                            <option value="" label=""></option>
                                            @foreach ($kecamatan as $item)
                                                <option value="{{ $item->kecamatan_id }}" @selected($item->kecamatan_id == $peternak->kecamatan_id)>
                                                    {{ $item->kecamatan_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="peternak_tempatlahir">Tempat Lahir</label>
                                    <div class="col-lg-12">
                                        <input id="peternak_tempatlahir" name="peternak_tempatlahir" type="text"
                                            placeholder="Tempat Lahir"
                                            value="{{ old('peternak_tempatlahir', $peternak->peternak_tempatlahir) }}"
                                            class="form-control btn-square input-md">
                                        @error('peternak_tempatlahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="peternak_tgllahir">Tanggal Lahir</label>
                                    <div class="col-lg-12">
                                        <input id="peternak_tgllahir" name="peternak_tgllahir"
                                            value="{{ old('peternak_tgllahir', $peternak->peternak_tgllahir) }}"
                                            type="date" placeholder="Tanggal Lahir"
                                            class="form-control btn-square input-md">
                                        @error('peternak_tgllahir')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <div class="col-lg-2">
                                        <img src="{{ asset('storage/' . $peternak->peternak_foto) }}" alt=""
                                            class="img-thumbnail">
                                    </div>
                                    <div class="col-lg-10 row">
                                        <label class="col-lg-12 form-label " for="file">Foto</label>
                                        <span class="small text-primary">*Biarkan kosong jika tidak ingin mengubah
                                            gambar.</span>
                                        <div class="col-lg-12">
                                            <input id="file" name="file" type="file"
                                                placeholder="placeholder" class="form-control btn-square input-md"
                                                value="{{ old('file') }}">
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <h6 class="m-t-10">Informasi Akun</h6>
                                <hr>

                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="email">Email</label>
                                    <div class="col-lg-12">
                                        <input id="email" name="email" type="email" placeholder="Email"
                                            class="form-control btn-square input-md"
                                            value="{{ old('email', $peternak->user->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <a class="btn btn-secondary" href="{{ route('peternak.index') }}"> <i
                                        class="icon-angle-double-left"></i>Kembali</a>
                                <button class="btn btn-primary" type="submit">Update Peternak</button>
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
