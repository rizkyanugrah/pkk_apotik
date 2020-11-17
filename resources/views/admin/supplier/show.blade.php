@extends('layouts.stisla.index', ['title' => 'Detail ' . $supplier->nama_supplier, 'header' => 'Detail Supplier' . $supplier->nama_supplier])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <table class="table">
                <tr>
                    <td style="width: 145px;">Nama Supplier</td>
                    <td style="width: 10px;">:</td>
                    <td class="text-wrap">{{ $supplier->nama_supplier }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $supplier->alamat }}</td>
                </tr>
                <tr>
                    <td>No Handphone</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $supplier->nomor_handphone }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($supplier->gambar) }}" class="img-thumbnail" alt="{{ $supplier->nama_supplier }}">
        </div>
        <div class="py-4">
            <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('admin.supplier.edit', $supplier->id) }}" data-id="{{ $supplier->id }}" class="btn btn-success">Ubah</a>
        </div>
    </div>
</div>
@endsection