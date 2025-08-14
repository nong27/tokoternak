@extends('template.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $title }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.index') }}">Operator</a></li>
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
                        <h5>Form Operator</h5><span>Edit data diri dan akun operator.</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('operator.update') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            <fieldset>

                                <!-- Form Name -->
                                <h6 class="m-t-10">Identitas Operator</h6>
                                <hr>
                                @csrf
                                <input type="hidden" name="operator_id" value="{{ $operator->operator_id }}">
                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="operator_nama">Nama Lengkap</label>
                                    <div class="col-lg-12">
                                        <input id="operator_nama" name="operator_nama" type="text"
                                            placeholder="Nama Lengkap" class="form-control btn-square input-md"
                                            value="{{ old('operator_nama', $operator->operator_nama) }}">
                                        @error('operator_nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>


                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="operator_hp">No HP</label>
                                    <div class="col-lg-12">
                                        <input id="operator_hp" value="{{ old('operator_hp', $operator->operator_hp) }}"
                                            name="operator_hp" type="text" placeholder="No HP"
                                            class="form-control btn-square input-md">
                                        @error('operator_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Textarea -->
                                <div class="mb-3 row mb-0">
                                    <label class="col-lg-12 form-label " for="operator_alamat">Alamat Operator</label>
                                    <div class="col-lg-12">
                                        <textarea class="form-control btn-square" id="operator_alamat" name="operator_alamat">{{ old('operator_alamat', $operator->operator_alamat) }}</textarea>
                                        @error('operator_alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row mb-0">
                                    <label class="col-lg-12 form-label " for="kecamatan_id">Kecamatan</label>
                                    <div class="col-lg-12">
                                        <select id="selectbasic" name="kecamatan_id" class="form-select btn-square">
                                            <option value="" label=""></option>
                                            @foreach ($kecamatan as $item)
                                                <option value="{{ $item->kecamatan_id }}" @selected($item->kecamatan_id == $operator->kecamatan_id)>
                                                    {{ $item->kecamatan_nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <h6 class="m-t-10">Informasi Akun</h6>
                                <hr>

                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="email">Email</label>
                                    <div class="col-lg-12">
                                        <input id="email" name="email" type="email" placeholder="Email"
                                            class="form-control btn-square input-md"
                                            value="{{ old('email', $operator->user->email) }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <a class="btn btn-secondary" href="{{ route('operator.index') }}"> <i
                                        class="icon-angle-double-left"></i>Kembali</a>
                                <button class="btn btn-primary" type="submit">Update Operator</button>
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
