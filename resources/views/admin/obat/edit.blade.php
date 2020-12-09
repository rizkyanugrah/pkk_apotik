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
                        <td>Kategori</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control select2-dropdown" id="kategori" name="kategori">
                                <option selected>Pilih Kategori..</option>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $kategori->id === $medicine->kategori_id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control select2-dropdown" id="jenis" name="jenis">
                                <option selected>Pilih Jenis..</option>
                                @foreach($jeniss as $jenis)
                                <option value="{{ $jenis->id }}" {{ $jenis->id === $medicine->jenis_id ? 'selected' : '' }}>{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control select2-dropdown" id="satuan" name="satuan">
                                <option selected>Pilih Satuan..</option>
                                @foreach($satuans as $satuan)
                                <option value="{{ $satuan->id }}" {{ $satuan->id === $medicine->satuan_id ? 'selected' : '' }}>{{ $satuan->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Harga Beli</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="harga_beli" id="rupiah" value="Rp. {{ number_format($medicine->harga_beli, 0, ',', '.') }}">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Harga Jual</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="harga_jual" id="uang" value="Rp. {{ number_format($medicine->harga_jual, 0, ',', '.') }}">
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
                    {{-- <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="number" class="form-control" name="stok" id="languages_edit" value="{{ $medicine->stok }}">
                        </td>
                    </tr> --}}
                    <tr>
                        <td>Indikasi</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <input type="text" class="form-control" name="indikasi" id="languages_edit" value="{{ $medicine->indikasi }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Supplier</td>
                        <td>:</td>
                        <td class="text-wrap">
                            <select class="form-control select2-dropdown" id="supplier" name="supplier">
                                <option selected>Pilih Supplier..</option>
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

@push('js')
<script type="text/javascript">
    var rupiah = document.getElementById('rupiah'); 
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        var nama =prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        return nama; 
    }
    var uang = document.getElementById('uang'); 
    uang.addEventListener('keyup', function(e){
        uang.value = formatuang(this.value, 'Rp. ');
    });

    function formatuang(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        uang     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            uang += separator + ribuan.join('.');
        }

        uang = split[1] != undefined ? uang + ',' + split[1] : uang;
        var namax =prefix == undefined ? uang : (uang ? 'Rp. ' + uang : '');
        return namax; 
    }
</script>
@endpush