@extends('layouts.app')

@section('sidebar')
    @include('admin.side-bar')
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Data Candidat</h1>

                <!-- Card Table -->
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="data_tabel" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Visi</th>
                                    <th>Misi</th>
                                    <th>Wilayah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidat as $a)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $a->photo) }}" alt="" width="80"
                                                height="80">
                                        </td>
                                        <td>
                                            <h5>{{ $a->kandidat->name }}</h5>
                                        </td>
                                        <td>{{ $a->visi }}</td>
                                        <td>{{ $a->misi }}</td>
                                        <td>{{ $a->wilayah->nama_wilayah }}</td>
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
