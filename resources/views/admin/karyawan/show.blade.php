@extends('layouts.stisla.index', ['title' => 'Detail ' . $karyawan->name, 'header' => 'Detail Karyawan' . $karyawan->nama_obat])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <table class="table">
                <tr>
                    <td style="width: 145px;">Nama Karyawan</td>
                    <td style="width: 10px;">:</td>
                    <td class="text-wrap">{{ $karyawan->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $karyawan->email }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $karyawan->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>alamat</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $karyawan->alamat }}</td>
                </tr>
                <tr>
                    <td>No_Telp</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $karyawan->no_telp }}</td>
                </tr>
                <tr>

                    <td>Role</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $karyawan->role->name }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($karyawan->gambar) }}" class="img-thumbnail">
        </div>
        <div class="py-4">
            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" data-id="{{ $karyawan->id }}" class="btn btn-success">Ubah</a>
        </div>
    </div>
</div>
@endsection