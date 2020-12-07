@extends('layouts.stisla.index', ['title' => 'Ubah ' . $karyawan->name, 'header' => 'Ubah ' . $karyawan->name])

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data" id="form_book_update">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <table class="table">
                    <tr>
                        <td style="width: 145px;">Nama karyawan</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="nama_karyawan" id="title_edit" value="{{ $karyawan->name }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 145px;">Email</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="email" class="form-control" name="email" id="title_edit" value="{{ $karyawan->email }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 145px;">Jenis Kelamin</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                        <select class="form-control select-dropdown" id="jk" name="jk">
                            <option {{$karyawan->jenis_kelamin === "Laki-Laki" ? 'selected' : ''}}>Laki-Laki</option>
                            <option {{$karyawan->jenis_kelamin === "Wanita" ? 'selected' : ''}}>Wanita</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 145px;">Alamat</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="alamat" id="title_edit" value="{{ $karyawan->alamat }}">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 145px;">No_Telp</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="no_telp" id="title_edit" value="{{ $karyawan->no_telp }}">
                        </td>
                    </tr>
                </table>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card">
            <img src="{{ asset($karyawan->gambar) }}" class="img-thumbnail" alt="{{ $karyawan->gambar }}" id="image_preview">
        </div>

        <div class="custom-file">
            <input type="file" name="gambar" class="custom-file-input" id="gambar_edit">
            <label class="custom-file-label" for="gambar" id="custom-file-label">Pilih file..</label>
        </div>

        <div class="py-4">
            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-primary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>

        </form>

    </div>
</div>
@endsection