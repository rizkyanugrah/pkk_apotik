@extends('layouts.stisla.index', ['title' => 'Transaksi Penjualan', 'header' => 'Transaksi Penjualan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3 justify-content-end">
                    <button type="button" id="add" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        + Tambah
                    </button>
                </div>
            </div>        
        <table class="table table-hovered text-center table-bordered" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama_Pembeli</th>
                    <th scope="col">Nama_Obat</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Total Obat</th>
                    <th scope="col">harga</th>
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-success">Simpan</button>                    
                <a href="{{ route('admin.obat_keluar.index') }}" type="submit" class="btn btn-danger">Batal</a>                    
            </div>
            <div class="col-lg-6 text-right">
                <h3>Total : RP.3600000</h3>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Apotaker</label>
                        <input name="apotaker" type="text" class="form-control" id="apotaker" readonly value="{{auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="name">satuan</label>
                        <input name="apotaker" type="text" class="form-control" id="apotaker" readonly value="{{auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="name">harga</label>
                        <input name="apotaker" type="text" class="form-control" id="apotaker" readonly value="{{auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="text" class="form-control" id="tanggal_transaksi" readonly name="tanggal_transaksi" value="{{ date("d-m-Y")}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Pembeli</label>
                        <input name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="obat">Obat</label>
                        <select name="obat" class="form-control" id="obat">
                            <option selected>Pilih Obat...</option>
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}">{{ $obat->nama_obat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input name="jumlah" type="number" class="form-control" id="jumlah">
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

@push('js')
<script>
    $(function() {
        const sessionItemName = "table"
            // delete session data on first load
        $(window).on('load', function() {
                sessionStorage.removeItem(sessionItemName);
            })
            // set row to table
        function setTableItem() {
            const data = JSON.parse(sessionStorage.getItem(sessionItemName) || "[]")
            $("#table tbody").empty();
            data.map((item, index) => {
                $("#table tbody").append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.obat}</td>
                        <td>${item.jumlah}</td>
                        <td>${item.tanggal_transaksi}</td>
                        <td>
                            <button class="btn btn-sm btn-success mr-2 edit-btn" data-index="${index}">Ubah</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-index="${index}">Hapus</button>
                        </td>
                    </tr>
                `)
            })
            if (data.length === 0) {
                $("#table tbody").append(`<td colspan="5" class="text-center">Tidak ada data</td>`)
            }
        }

        function deleteItem(itemIndex) {
            const data = JSON.parse(sessionStorage.getItem(sessionItemName)).filter((item, index) => index !== itemIndex)
            sessionStorage.setItem(sessionItemName, JSON.stringify(data));
            setTableItem();
        }
        // Reset Button
        $("#reset").click(function() {
                sessionStorage.removeItem(sessionItemName)
                setTableItem();
            })
            // add new item or update item
        $("#form").on('submit', function(e) {
                e.preventDefault()
                const data = JSON.parse(sessionStorage.getItem(sessionItemName) || "[]")
                const member = $(this).serializeArray().reduce(
                    (obj, item) => Object.assign(obj, {
                        [item.name]: item.value
                    }), {});
                // Jika ada item dengan nama yang sama, maka hapus kemudian buat baru, jika tidak maka tambahkan
                const storedData = !!data.find(item => item.name === member.name) ? [...data.filter((item) => item.name !== member.name), member] : [...data, member];
                sessionStorage.setItem(sessionItemName, JSON.stringify(storedData));
                setTableItem();
                $("#form")[0].reset();
                $("#addModal").modal('hide')
            })
            // delete item
        $(document).on('click', ".delete-btn", function() {
                deleteItem(parseInt($(this).data("index")))
            })
            // edit item
        $(document).on('click', ".edit-btn", function() {
            const item = JSON.parse(sessionStorage.getItem(sessionItemName)).filter((item, index) => index === parseInt($(this).data("index")))[0]
            $("#form input[name='name']").val(item.name)
            $("#form input[name='level']").val(item.level)
            $("#form select").val(item.class)
            $("#addModal").modal('show')
        })
    })
</script>
@endpush