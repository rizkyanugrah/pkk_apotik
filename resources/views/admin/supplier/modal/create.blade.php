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
                <form action="{{ route('admin.supplier.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nama_supplier">Nama Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="no_hp">Nomor Handphone</label>
                                <input type="number" class="form-control" id="no_hp" name="no_hp">
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