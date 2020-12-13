@extends('layouts.stisla.index', ['title' => 'Tambah Transaksi Pembelian', 'header' => 'Tambah Transaksi Pembelian'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <form id="add-transaction">
                <div class="form-group">
                    <label for="apoteker">Apoteker</label>
                    <input name="apoteker" type="text" class="form-control" id="apoteker" readonly value="{{auth::user()->name}}">
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" class="form-control select2-dropdown" id="supplier">
                        <option selected>Pilih Supplier...</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="text" class="form-control" id="tanggal_transaksi" readonly name="tanggal_transaksi" value="{{ date("d-m-Y")}}">
                </div>
                <div class="row">
                    <div class="col-lg-12 px-3 py-3 justify-content-end">
                        <button type="button" id="add" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            + Tambah Obat
                        </button>
                    </div>
                </div>

                <table class="table table-hovered text-center table-bordered" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Total Obat</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total Biaya</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.pembelian.index') }}" type="submit" class="btn btn-danger">Batal</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <h5 id="total-price">Total : RP 0</h5>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="modal fade" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form" action="" method="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Tambah Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input name="unit" type="hidden" class="form-control" id="unit">
                            <input name="price" type="hidden" class="form-control" id="price">
                            <input name="drugName" type="hidden" class="form-control" id="drugName">

                            <div class="form-group">
                                <label for="obat">Obat</label>
                                <select name="obat" class=" select2-dropdown" id="obat">
                                    <option selected>Pilih Obat...</option>
                                    @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}" data-name="{{$obat->nama_obat}}" data-price="{{$obat->harga_beli}}" data-unit="{{$obat->satuans->nama_satuan}}">{{ $obat->nama_obat }}</option>
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
        @endsection

        @push('js')
        <script>
            $(function() {
                const sessionItemName = "buy-transaction"
                // delete session data on first load
                $(window).on('load', function() {
                    sessionStorage.removeItem(sessionItemName);
                })
                // set row to table
                function setTableItem() {
                    const totalPriceText = $("#total-price");
                    const data = JSON.parse(sessionStorage.getItem(sessionItemName) || "[]")
                    $("#table tbody").empty();
                    const totalPrice = data.reduce((a, b) => a += (parseInt(b.price || "0") * parseInt(b.jumlah || "0")), 0).toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                    totalPriceText.html(totalPrice)
                    data.map((item, index) => {
                        $("#table tbody").append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.drugName}</td>
                            <td>${item.unit}</td>
                            <td>${item.jumlah}</td>
                            <td>${parseInt(item.price).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            })}</td>
                            <td>${(parseInt(item.price) * parseInt(item.jumlah)).toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            })}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-btn" data-index="${index}">Hapus</button>
                            </td>
                        </tr>
                    `)
                    })
                    if (data.length === 0) {
                        $("#table tbody").append(`<td colspan="8" class="text-center">Tidak ada data</td>`)
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
                    const obat = $(this).serializeArray().reduce(
                        (obj, item) => Object.assign(obj, {
                            [item.name]: item.value
                        }), {});
                        
                    // Jika ada item dengan nama yang sama, maka hapus kemudian buat baru, jika tidak maka tambahkan
                    const storedData = !!data.find(item => item.obat === obat.obat) ? [...data.filter((item) => item.obat !== obat.obat), obat] : [...data, obat];
                    sessionStorage.setItem(sessionItemName, JSON.stringify(storedData));
                    setTableItem();
                    $("#form")[0].reset();
                    $('#form #select2-obat-container').html("Pilih Obat...")
                    $("#addModal").modal('hide')
                })
                // Submit
                $("#add-transaction").on('submit', function(e) {
                    e.preventDefault();
                    const data = {
                        supplier: $("#add-transaction select[name='supplier']").val(),
                        transaction_date: $("#add-transaction input[name='tanggal_transaksi']").val(),
                        details: JSON.parse(sessionStorage.getItem(sessionItemName)).map(({
                            obat,
                            jumlah
                        }) => ({
                            id: obat,
                            total: jumlah
                        }))
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/admin/pembelian',
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Data berhasil ditambah.",
                                icon: "success",
                                timerProgressBar: true,
                                onBeforeOpen: () => {
                                    Swal.showLoading();
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent();
                                        if (content) {
                                            const b = content.querySelector("b");
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft();
                                            }
                                        }
                                    }, 100);
                                },
                                showConfirmButton: false
                            });
                            sessionStorage.removeItem(sessionItemName);
                            window.location.href = '/admin/pembelian';
                        },
                        error: function(request, status, error) {
                            console.log(request, status, error)
                            Swal.fire({
                                title: "Gagal",
                                text: request.responseJSON.errors,
                                icon: "error",
                            }).then(function() {
                                sessionStorage.removeItem(sessionItemName);
                                window.location.href = '/admin/pembelian';
                            })
                        }
                    })
                })
                $('#form select').on('change', function() {
                    const drug = $(this).find(':selected');
                    $("#form input[name='drugName']").val(drug.data("name"));
                    $("#form input[name='price']").val(drug.data("price"));
                    $("#form input[name='unit']").val(drug.data("unit"));
                })
                // delete item
                $(document).on('click', ".delete-btn", function() {
                    deleteItem(parseInt($(this).data("index")))
                })
                // edit item
                $(document).on('click', ".edits-btn", function() {
                    const item = JSON.parse(sessionStorage.getItem(sessionItemName)).filter((item, index) => index === parseInt($(this).data("index")))[0]
                    $("#form input[name='jumlah']").val(item.jumlah)
                    $("#form select").val(item.obat)
                    $("#addModal").modal('show')
                })
            })
        </script>
        @endpush