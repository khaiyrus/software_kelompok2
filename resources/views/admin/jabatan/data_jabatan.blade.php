@extends('layouts.app')

@section('sidebar')
    @include('admin.side-bar')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Data Wilayah</h1>
                <a href="{{ route('admin.jabatan_add') }}"class="btn btn-primary mb-3"  >
                    Tambah Data
                </a>

                <!-- Card Table -->
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="data_tabel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Wilayah</th>
                                    <th class="text-center">Tingkatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatan as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->nama }}</td>
                                    <td>{{ $a->level }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.jabatan_edit', $a->id) }}" class="btn btn-sm btn-primary">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a href="{{ route('admin.jabatan_hapus', $a->id) }}" onclick="return confirm('yakin dek ?')" class="btn btn-sm btn-danger">
                                            <i data-feather="trash-2"></i>
                                        </a>
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
@endsection
