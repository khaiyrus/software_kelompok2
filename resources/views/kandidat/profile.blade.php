@extends('layouts.app')
@section('sidebar')
    @include('kandidat.sidebar')
@endsection
@section('content')
    <div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Pengaturan Akun</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white">
                    <h5 class="card-title mb-0">Profil</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 text-center">
                        <img src="{{ asset('storage') }}/{{ Auth::user()->profil->photo ?? '' }}" alt="Foto Profil"
                            class="img-fluid rounded-circle mb-2 border border-primary"
                            onerror="this.onerror=null; this.src='{{ asset('build/assets/img/flat.jpg') }}';"
                             style="width: 150px;"/>
                        <div class="mt-2">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <p class="text-muted">nama/username</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <p class="form-control-plaintext">{{ Auth::user()->name ?? '' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Wilayah</label>
                        <p class="form-control-plaintext">{{ Auth::user()->profil->wilayah->nama_wilayah ?? '' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">{{ Auth::user()->email ?? ''}}</p>
                        <small class="text-muted">Email baru akan memerlukan verifikasi.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Visi</label>
                        <p class="form-control-plaintext">{{ Auth::user()->profil->visi ?? ''}}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Misi</label>
                        <p class="form-control-plaintext">{{ Auth::user()->profil->misi ?? ''}}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('kandidat.add_profile') }}"class="btn btn-primary mb-3"  >
                    Edit Data
                </a>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white">
                    <h5 class="card-title mb-0">Hapus Akun</h5>
                </div>
                <div class="card-body">
                    <p class="text-danger">Menghapus akun akan menghapus semua data Anda secara permanen dan tidak dapat dipulihkan.</p>
                    <button class="btn btn-danger" onclick="confirmDeleteAccount()">Hapus Akun</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDeleteAccount() {
            if (confirm('Apakah Anda yakin ingin menghapus akun Anda?')) {
                window.location.href = '/delete-account';
            }
        }
    </script>
</div>

@endsection
