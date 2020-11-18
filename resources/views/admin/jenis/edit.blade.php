@extends('layouts.stisla.index', ['title' => 'Ubah ' . $jenis->nama_jeniss, 'header' => 'Ubah ' . $jenis->nama_jenis])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.jenis.update', $jenis->id) }}" method="POST" enctype="multipart/form-data" id="form_book_update">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <table class="table">
                    <div class="py-4 ml-4">
                        <a href="{{ route('admin.jenis.index') }}" class="btn btn-warning">< Kembali</a>
                        <hr>
                    </div>
                    <tr>
                        <td style="width: 145px;">Nama Obat</td>
                        <td style="width: 10px;">:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="nama_jenis" id="title_edit" value="{{ $jenis->nama_jenis }}">
                        </td>
                    </tr>
                </table>
                <div class="py-4 ml-4">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection