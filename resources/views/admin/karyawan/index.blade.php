@extends('layouts.stisla.index', ['title' => 'Daftar Karyawan', 'header' => 'Karyawan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                        Tambah Data
                    </button>
                </div>
            </div>
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session()->get('success') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <table class="table table-hovered text-center table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Karyawan</th>
                        <th>email</th>
                        <th>Jenis Kelamin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $key => $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->name }}</td>
                        <td>{{ $karyawan->email }}</td>
                        <td>{{ $karyawan->jenis_kelamin }}</td>
                        <td>
                            <a href="{{ route('admin.karyawan.show', $karyawan->id) }}" class="btn btn-sm btn-info text-white" title="Lihat data">
                                <i class="fas fa-fw fa-search"></i>
                            </a>
                            @if(auth()->user()->role_id === 1)
                            <a href="{{ route('admin.obat.edit', $karyawan->id) }}" class="btn btn-sm btn-warning text-white" title="Ubah data">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            @if(auth()->user()->id !== $karyawan->id)
                            <a href="#" class="btn btn-sm btn-danger text-white" title="Hapus data">
                                <i class="fas fa-fw fa-trash"></i>
                            </a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('modal')
@include('admin.karyawan.modal.create')
@endpush