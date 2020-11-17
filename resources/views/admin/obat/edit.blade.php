@extends('layouts.stisla.index', ['title' => 'Ubah ' . $medicine->nama_obat, 'header' => 'Ubah ' . $medicine->nama_obat])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <form action="{{ route('admin.obat.update', $medicine->id) }}" method="POST" enctype="multipart/form-data" id="form_book_update">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <table class="table">
                    <tr>
                        <td style="width: 145px;">Nama Obat</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="nama_obat" id="title_edit" value="{{ $medicine->nama_obat }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Aturan Minum</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="aturan_minum" id="book_number_edit" value="{{ $medicine->aturan_minum }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="satuan" id="publisher_edit" value="{{ $medicine->satuan }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="harga" id="publisher_edit" value="{{ $medicine->harga }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Kadaluarsa</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control" id="is_expired" name="is_expired">
                                <option selected>Pilih..</option>
                                <option value="1" {{ $medicine->is_expired === 1 ? 'selected' : '' }}>Ya</option>
                                <option value="0" {{ $medicine->is_expired === 0 ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Kadaluarsa</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="date" class="form-control" name="tanggal_kadaluarsa" id="languages_edit" value="{{ $medicine->tanggal_kadaluarsa }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control" id="supplier" name="supplier">
                                <option selected>Pilih Supplier</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ $supplier->id === $medicine->supplier_id ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($medicine->gambar) }}" class="img-thumbnail" alt="{{ $medicine->nama_obat }}" id="image_preview">
        </div>

        <div class="custom-file">
            <input type="file" name="gambar" class="custom-file-input" id="gambar_edit">
            <label class="custom-file-label" for="gambar" id="custom-file-label">Pilih file..</label>
        </div>

        <div class="py-4">
            <a href="{{ route('admin.obat.index') }}" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>

        </form>

    </div>
</div>
@endsection