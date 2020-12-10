<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.obat.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" class="form-control" id="nama_obat" name="nama_obat">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="aturan_minum">Aturan Minum</label>
                                <input type="text" class="form-control" id="aturan_minum" name="aturan_minum" placeholder="Contoh : 3x1">
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control select2-dropdown" id="kategori" name="kategori">
                                    <option selected>Pilih Kategori..</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="jenis">Jenis</label>
                                <select class="form-control select2-dropdown" id="jenis" name="jenis">
                                    <option selected>Pilih Jenis..</option>
                                    @foreach($jeniss as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <select class="form-control select2-dropdown" id="satuan" name="satuan">
                                    <option selected>Pilih Satuan..</option>
                                    @foreach($satuans as $satuan)
                                        <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                                <input type="date" class="form-control" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">    
                                <label for="kadaluarsa">Kadaluarsa</label>
                                <select class="form-control" id="is_expired" name="is_expired">
                                    <option selected>Pilih..</option>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="rupiah">Harga Beli</label>
                                <input type="text" class="form-control" id="rupiah" name="harga_beli">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="uang">Harga Jual </label>
                                <input type="text" class="form-control" id="uang" name="harga_jual">
                            </div>
                        </div>
                        {{-- <div class="col-lg-4">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="supplier">Supplier</label>
                                <select class="form-control select2-dropdown" id="supplier" name="supplier">
                                    <option selected>Pilih Supplier..</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="indikasi">Indikasi</label>
                                <input type="text" class="form-control" id="indikasi" name="indikasi" placeholder="contoh: indikasi demam batu pilek">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="image_create">
                                <label class="custom-file-label" for="gambar" id="custom-file-label">Pilih file..</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="text-center">
                                <img src="" class="img img-thumbnail shadow" alt="" id="image_preview" height="100" width="100">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

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
