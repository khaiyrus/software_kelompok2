@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Data Admin</h1>

                <!-- Tombol Tambah -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahdata">
                    Tambah Data
                </button>

                <!-- Card Table -->
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="data_tabel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>virus</td>
                                    <td>virus@gmail.com</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updatedata25">
                                            <i data-feather="edit"></i>
                                        </button>
                                        <a href="{{ url('data_admin/delete/25') }}" class="btn btn-sm btn-danger">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>hairus</td>
                                    <td>khaiyrus378@gmail.com</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#updatedata40">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('data_admin/delete/40') }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
