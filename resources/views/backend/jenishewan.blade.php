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
                        <h5>Data Jenis Hewan</h5><span>Daftar jenis hewan yang dapat diinput oleh penjual/peternak</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Hewan</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($jenishewan as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->jenishewan_nama }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                                                    data-bs-toggle="modal" data-bs-target="#edit"
                                                    data-id="{{ $row->jenishewan_id }}"
                                                    data-nama="{{ $row->jenishewan_nama }}"><i class="icon-pencil"></i>
                                                    Edit</a>
                                                <a class="btn btn-danger btn-sm" href="javascript:void(0)"
                                                    data-bs-toggle="modal" data-bs-target="#hapus"
                                                    data-id="{{ $row->jenishewan_id }}"><i class="icon-trash"></i>
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
                    <h5 class="modal-title">Tambah Jenis Hewan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jenishewan.insert') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>

                            <!-- Form Name -->
                            <h6 class="m-t-10">Data Jenis Hewan</h6>
                            <hr>
                            @csrf
                            <!-- Text input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="jenishewan_nama">Jenis Hewan</label>
                                <div class="col-lg-12">
                                    <input id="jenishewan_nama" name="jenishewan_nama" type="text"
                                        placeholder="Jenis Hewan" class="form-control btn-square input-md"
                                        value="{{ old('jenishewan_nama') }}">
                                    @error('jenishewan_nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Tambah Jenis Hewan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Jenis Hewan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jenishewan.update') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>

                            <!-- Form Name -->
                            <h6 class="m-t-10">Data Jenis Hewan</h6>
                            <hr>
                            @csrf
                            <input type="hidden" name="jenishewan_id" value id="kodeitemedit">
                            <!-- Text input-->
                            <div class="mb-3 row">
                                <label class="col-lg-12 form-label " for="jenishewan_nama">Jenis Hewan</label>
                                <div class="col-lg-12">
                                    <input name="jenishewan_nama" type="text" placeholder="Jenis Hewan"
                                        class="form-control btn-square input-md" id="namaitemedit">
                                    @error('jenishewan_nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Ubah Jenis Hewan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="hapus" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Jenis Hewan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jenishewan.delete') }}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <fieldset>
                            <!-- Form Name -->
                            <h6 class="m-t-10">Yakin ingin menghapus data jenis hewan?</h6>
                            @csrf
                            <input type="hidden" name="jenishewan_id" value id="kodeitemhapus">

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
        $('#edit').on('show.bs.modal', function(event) {
            var kode = $(event.relatedTarget).data('id');
            var nama = $(event.relatedTarget).data('nama');
            console.log(nama);

            $(this).find('#kodeitemedit').attr("value", kode);
            $(this).find('#namaitemedit').attr("value", nama);
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
