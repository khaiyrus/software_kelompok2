@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Data Wilayah</h1>
                <a href="{{ route('admin.wilayah_add') }}"class="btn btn-primary mb-3"  >
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wilayah as $a)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->nama_wilayah }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updatedata40">
                                            <i data-feather="edit"></i>
                                        </button>
                                        <a href="" class="btn btn-sm btn-danger">
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
