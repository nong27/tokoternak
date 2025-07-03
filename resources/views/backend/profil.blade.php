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
        <div class="row d-flex justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Ganti Password</h5><span></span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.gantiPassword') }}" class="form-horizontal" method="POST"
                            enctype="multipart/form-data">
                            <fieldset>

                                <h6 class="m-t-10">Profil</h6>
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
                                <!-- Text input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="hewan_nama">Email</label>
                                    <div class="col-lg-12">
                                        <input id="" name="" type="text" placeholder=" Hewan"
                                            class="form-control btn-square input-md" value="{{ $user->email }}" disabled>
                                        @error('')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Password input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="current_password">Password Sekarang</label>
                                    <div class="col-lg-12">
                                        <input id="current_password" name="current_password" type="password"
                                            placeholder="Password Sekarang" class="form-control btn-square input-md">
                                        @error('user_pasword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="user_password">Password Baru</label>
                                    <div class="col-lg-12">
                                        <input id="user_password" name="user_password" type="password"
                                            placeholder="Password Baru" class="form-control btn-square input-md">
                                        @error('user_pasword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password input-->
                                <div class="mb-3 row">
                                    <label class="col-lg-12 form-label " for="password_confirmation">Password
                                        Confirmation</label>
                                    <div class="col-lg-12">
                                        <input id="password_confirmation" name="password_confirmation" type="password"
                                            placeholder="Konfirmasi Password Baru" class="form-control btn-square input-md">
                                        @error('password_confirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Ganti Password</button>
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
