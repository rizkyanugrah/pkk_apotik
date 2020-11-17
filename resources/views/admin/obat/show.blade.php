@extends('layouts.stisla.index', ['title' => 'Detail ' . $medicine->nama_obat, 'header' => 'Detail Obat' . $medicine->nama_obat])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <table class="table">
                <tr>
                    <td style="width: 145px;">Nama Obat</td>
                    <td style="width: 10px;">:</td>
                    <td class="text-wrap">{{ $medicine->nama_obat }}</td>
                </tr>
                <tr>
                    <td>Aturan Minum</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $medicine->aturan_minum }}</td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $medicine->satuan }}</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $medicine->harga }}</td>
                </tr>
                <tr>
                    <td>Expired</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $medicine->harga }}</td>
                </tr>
                <tr>
                    <td>Nama Supplier</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $medicine->suppliers->nama_supplier }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($medicine->gambar) }}" class="img-thumbnail" alt="{{ $medicine->nama_obat }}">
        </div>
        <div class="py-4">
            <a href="{{ route('admin.obat.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('admin.obat.edit', $medicine->id) }}" data-id="{{ $medicine->id }}" class="btn btn-success">Ubah</a>
        </div>
    </div>
</div>
@endsection