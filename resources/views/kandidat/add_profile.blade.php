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
                        <h5 class="card-title mb-0">Edit Profil</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kandidat.profile_add_proses') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 text-center">
                                <img src="{{ asset('assets-dashboard') }}/img/avatars/avatar-4.jpg" alt="Foto Profil"
                                    class="img-fluid rounded-circle mb-2 border border-primary" width="128"
                                    height="128"
                                    onerror="this.onerror=null; this.src='{{ asset('build/assets/img/flat.jpg') }}';" />
                                <div class="mt-2">
                                    <label for="profilePicture" class="form-label">Ubah Foto Profil</label>
                                    <input type="file" id="profilePicture" name="profilePicture" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="visi" class="form-label">Visi</label>
                                <textarea class="form-control" id="visi" name="visi" rows="2" placeholder="Textarea"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="misi" class="form-label">Misi</label>
                                <textarea class="form-control" id="misi" name="misi" rows="2" placeholder="Textarea"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="label">Pilih Jabatan</label>
                                <div class="form-group position-relative">
                                    <select name="jabatan_id" class="form-select form-control ps-5 h-58"
                                        aria-label="Pilih Jabatan" required>
                                        <option value="" disabled selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}" class="text-dark">{{ $j->nama}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="ri-briefcase-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="label">Pilih Wilayah</label>
                                <div class="form-group position-relative">
                                    <select name="wilayah_id" class="form-select form-control ps-5 h-58"
                                        aria-label="Pilih Wilayah" required>
                                        <option value="" disabled selected>Pilih Wilayah</option>
                                        @foreach ($wilayah as $a)
                                            <option value="{{ $a->id }}" class="text-dark">
                                                {{ $a->nama_wilayah }}</option>
                                        @endforeach
                                    </select>
                                    <i
                                        class="ri-briefcase-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0">Hapus Akun</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-danger">Menghapus akun akan menghapus semua data Anda secara permanen dan tidak dapat
                            dipulihkan.</p>
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
