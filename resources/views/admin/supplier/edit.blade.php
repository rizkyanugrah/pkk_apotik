@extends('layouts.stisla.index', ['title' => 'Ubah ' . $supplier->nama_supplier, 'header' => 'Ubah ' . $supplier->nama_supplier])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data" id="form_book_update">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <table class="table">
                    <tr>
                        <td style="width: 145px;">Nama Supplier</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="nama_supplier" id="title_edit" value="{{ $supplier->nama_supplier }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="alamat" id="book_number_edit" value="{{ $supplier->alamat }}">
                        </td>
                    </tr>
                    <tr>
                        <td>No_Handphone</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="no_hp" id="publisher_edit" value="{{ $supplier->nomor_handphone }}">
                        </td>
                    </tr>
                </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($supplier->gambar) }}" class="img-thumbnail" alt="{{ $supplier->nama_supplier }}" id="image_preview">
        </div>

        <div class="custom-file">
            <input type="file" name="gambar" class="custom-file-input" id="gambar_edit">
            <label class="custom-file-label" for="gambar" id="custom-file-label">Pilih file..</label>
        </div>

        <div class="py-4">
            <a href="{{ route('admin.supplier.index') }}" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>

        </form>

    </div>
</div>
@endsection