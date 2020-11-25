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
                {{-- <form action="" method="get" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="apotaker">Apotaker</label>
                            <input type="text" class="form-control" id="apotaker" name="apotaker" value="{{auth::user()->name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nama_obat">Nama Obat</label>
                                <input type="text" class="form-control" id="nama_obat" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                        </div>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form> --}}
            <form id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Apotaker</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="class">Kelas</label>
                        <select name="class" class="form-control" id="class">
                            <option selected>Vanguard</option>
                            <option>Arch Mage</option>
                            <option>Knight</option>
                            <option>Assassin</option>
                            <option>Ranger</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="level">Jumlah</label>
                        <input name="level" type="number" class="form-control" id="level">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
