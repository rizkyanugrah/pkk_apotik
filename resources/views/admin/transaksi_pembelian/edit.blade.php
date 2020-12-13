@extends('layouts.stisla.index', ['title' => 'Ubah Transaksi Pembelian', 'header' => 'Ubah Transaksi Pembelian'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <form id="edit-transaction" data-id="{{$transaction->id }}">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="apoteker">Apoteker</label>
                    <input name="apoteker" type="text" class="form-control" id="apoteker" readonly value="{{$transaction->user->name}}">
                </div>
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <select name="supplier" class="form-control select2-dropdown" id="supplier">
                        <option>Pilih Supplier...</option>
                        @foreach($suppliers as $supplier)
                        <option {{ $supplier->id === $transaction->supplier->id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_transaksi">Tanggal Transaksi</label>
                    <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="{{$transaction->tanggal_pembelian}}">
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
                        @foreach($transaction->details as $detail)
                        <tr data-unit="{{$detail->obat->satuans->nama_satuan}}" data-name="{{$detail->obat->nama_obat}}" data-price="{{$detail->obat->harga_beli}}" data-obat="{{$detail->obat->id}}" data-jumlah="{{$detail->total_obat}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$detail->obat->nama_obat}}</td>
                            <td>{{$detail->obat->satuans->nama_satuan}}</td>
                            <td>{{$detail->total_obat}}</td>
                            <td>Rp. {{ number_format($detail->obat->harga_beli, 0, ',', '.') }}</td>
                            <td>{{ $detail->cost}}</td>
                            <td>
                                <button class="btn btn-sm btn-success edit-btn" data-index="{{$loop->iteration - 1}}">Ubah</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-index="{{$loop->iteration - 1}}">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.obat_keluar.index') }}" type="submit" class="btn btn-danger">Batal</a>
                    </div>
                    <div class="col-lg-6 text-right">
                        <h5 id="total-price">Total : {{$transaction->cost}}</h5>
                    </div>
                </div>
            </form>
        </div>
        @endsection
        
        @push('modal')
        <div class="modal fade" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true">
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
                                    <option>Pilih Obat...</option>
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
            
        @endpush


        @push('js')
        <script>
            $(function() {
                const sessionItemName = "edit-buy-transaction"
                // delete session data on first load
                $(window).on('load', function() {
                    // [{"unit":"Keping","price":"146618","drugName":"Repellat.","obat":"1","jumlah":"2"}]
                    sessionStorage.removeItem(sessionItemName);
                    let data = [];
                    $("#table tbody tr").each(function() {
                        data.push({
                            unit: $(this).data("unit"),
                            price: `${$(this).data("price")}`,
                            drugName: $(this).data("name"),
                            obat: `${$(this).data("obat")}`,
                            jumlah: `${$(this).data("jumlah")}`,
                        })
                    })
                    console.log(data)
                    sessionStorage.setItem(sessionItemName, JSON.stringify(data));
                })
                // set row to table
                function setTableItem() {
                    const totalPriceText = $("#total-price");
                    const data = JSON.parse(sessionStorage.getItem(sessionItemName))
                    $("#table tbody").empty();
                    const totalPrice = data.map(item => parseInt(item.price) * parseInt(item.jumlah)).reduce((a, b) => a + b, 0).toLocaleString('id-ID', {
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
                                <button class="btn btn-sm btn-success mr-2 edit-btn" data-index="${index}">Ubah</button>
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
                    $("#addModal").modal('hide')
                })
                // Submit
                $("#edit-transaction").on('submit', function(e) {
                    e.preventDefault();
                    const data = {
                        supplier: $("#edit-transaction select[name='supplier']").val(),
                        transaction_date: $("#edit-transaction input[name='tanggal_transaksi']").val(),
                        details: JSON.parse(sessionStorage.getItem(sessionItemName)).map(({
                            obat,
                            jumlah
                        }) => ({
                            id: obat,
                            total: jumlah
                        })),
                        _method: "PUT"
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: `{{ url('admin/pembelian') }}/${$(this).data('id')}`,
                        type: 'POST',
                        data: data,
                        success: function(data) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Data berhasil diubah. Total obat akan berubah sesuai dengan data yang diubah",
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
                $(document).on('click', ".edit-btn", function(e) {
                    e.preventDefault()
                    const item = JSON.parse(sessionStorage.getItem(sessionItemName)).filter((item, index) => index === parseInt($(this).data("index")))[0]
                    $("#form input[name='jumlah']").val(item.jumlah)
                    $("#form select").val(item.obat)
                    $("#addModal").modal('show')
                })
            })
        </script>
        @endpush