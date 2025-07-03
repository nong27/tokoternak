@extends('template.front');
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Profil</h1>
    </div>
    <!-- Single Page Header End -->
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $user->pelanggan->nama_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>No Telp</th>
                            <td>{{ $user->pelanggan->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $user->pelanggan->alamat_jalan }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="text-start">
                <a href="{{ route('profil.edit') }}" class="btn border border-secondary rounded-pill px-3 text-primary">Edit
                    Profil</a>
            </div>
            <div class="text-end">
                <a href="{{ route('logout') }}"
                    class="btn border border-secondary rounded-pill px-3 text-primary">Logout</a>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
