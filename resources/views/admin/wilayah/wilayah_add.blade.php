@extends('layouts.app')

@section('sidebar')
    @include('admin.side-bar')
@endsection

@section('content')

<div class="d-sm-flex text-center justify-content-between align-items-center mb-4">
    <h3 class="mb-sm-0 mb-1 fs-18">Form Add Wilayah</h3>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card bg-white border-0 rounded-10 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.wilayah_add_proses') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Nama Wilayah -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Nama Wilayah</label>
                                <div class="form-group position-relative">
                                    <input type="text" name="nama_wilayah" class="form-control text-dark ps-5 h-58"
                                        placeholder="Masukkan Nama Wilayah" required>
                                    <i class="ri-map-pin-line position-absolute top-50 start-0 translate-middle-y fs-20 text-gray-light ps-20"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Level Wilayah -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Level Wilayah</label>
                                <select name="level" class="form-control" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="provinsi">Provinsi</option>
                                    <option value="kabupaten">Kabupaten</option>
                                    <option value="kota">Kota</option>
                                </select>
                            </div>
                        </div>

                        <!-- Parent Wilayah -->
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Parent Wilayah (Induk)</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">-- Tidak Ada / Root --</option>
                                    @foreach($parentWilayah as $wilayah)
                                        <option value="{{ $wilayah->id }}">{{ $wilayah->nama_wilayah }} ({{ $wilayah->level }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit"
                            class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
