@extends('layouts.app')

@section('sidebar')
    @include('admin.side-bar')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Data Admin</h1>

                <a href="{{ route('admin.voting_add') }}"class="btn btn-primary mb-3">
                    Tambah Data
                </a>

                <!-- Card Table -->
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="data_tabel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Acara</th>
                                    <th>Voting Sampai</th>
                                    <th>Wilayah</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voting as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->acara }}</td>
                                        <td>{{ $a->voting_sampai }}</td>
                                        <td>{{ $a->wilayah->nama_wilayah }}</td>
                                        <td>
                                            {{ $a->status == 1 ? 'Sudah Selesai' : 'Belum Selesai' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.voting_edit', $a->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{ route('admin.voting_hapus', $a->id) }}"
                                                onclick="return confirm('yakin dek ?')" class="btn btn-sm btn-danger">
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
