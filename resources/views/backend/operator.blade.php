@extends('template.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Operator</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Operator</li>
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
                        <h5>Daftar Operator</h5><span>Daftar operator terdaftar dalam sistem. Operator dapat menginput data
                            penjual di setiap Kecamatan</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>HP</th>
                                        <th>Kecamatan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($operator as $row)
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->operator_nama }}</td>
                                        <td>{{ $row->operator_alamat }}</td>
                                        <td>{{ $row->operator_hp }}</td>
                                        <td>{{ $row->kecamatan->kecamatan_nama }}</td>
                                        <td><a class="btn btn-success btn-sm active"
                                                href="{{ route('operator.edit', $row->operator_id) }}"><i
                                                    class="icon-pencil"></i>
                                                Edit</a>
                                            <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                                data-bs-toggle="modal" data-bs-target="#hapus"
                                                data-id="{{ $row->operator_id }}"><i class="icon-trash"></i>
                                                Hapus</a>
                                        </td>
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
                    <h5 class="modal-title">Tambah Operator</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('operator.insert') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>

                            <!-- Form Name -->
                            <h6 class="m-t-10">Identitas Operator</h6>
                            <hr>
                            @csrf
                            <!-- Text input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="operator_nama">Nama Lengkap</label>
                                <div class="col-lg-12">
                                    <input id="operator_nama" name="operator_nama" type="text" placeholder="Nama Lengkap"
                                        class="form-control btn-square input-md" value="{{ old('operator_nama') }}">
                                    @error('operator_nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                            <!-- Text input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="operator_hp">No HP</label>
                                <div class="col-lg-12">
                                    <input id="operator_hp" value="{{ old('operator_hp') }}" name="operator_hp"
                                        type="text" placeholder="No HP" class="form-control btn-square input-md">
                                    @error('operator_hp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="mb-3 row mb-0">
                                <label class="col-lg-12 form-label " for="operator_alamat">Alamat Operator</label>
                                <div class="col-lg-12">
                                    <textarea class="form-control btn-square" id="operator_alamat" name="operator_alamat">{{ old('operator_alamat') }}</textarea>
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
                                            <option value="{{ $item->kecamatan_id }}" @selected($item->kecamatan_id == old('kecamatan_id'))>
                                                {{ $item->kecamatan_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <h6 class="m-t-10">Informasi Akun</h6>
                            <hr>

                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="email">Email</label>
                                <div class="col-lg-12">
                                    <input id="email" name="email" type="email" placeholder="Email"
                                        class="form-control btn-square input-md" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Password input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="user_password">Password</label>
                                <div class="col-lg-12">
                                    <input id="user_password" name="user_password" type="password"
                                        placeholder="Password" class="form-control btn-square input-md">
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
                                        placeholder="Konfirmasi Password" class="form-control btn-square input-md">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Tambah Operator</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Operator</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('operator.delete') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>
                            <!-- Form Name -->
                            <h6 class="m-t-10">Yakin ingin menghapus data operator?</h6>
                            @csrf
                            <input type="hidden" name="operator_id" value id="kodeitemhapus">

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
