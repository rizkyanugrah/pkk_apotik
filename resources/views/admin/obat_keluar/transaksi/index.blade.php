@extends('layouts.stisla.index', ['title' => 'Transaksi Penjualan', 'header' => 'Transaksi Penjualan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3">
                    <a href="{{ route('admin.transaksi_jual.index') }}" type="button" class="btn btn-primary">
                        + Tambah
                    </a>
                </div>
            </div>
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session()->get('success') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

                <div class="row">
                    <div class="col-lg-6 px-3 py-3">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli">
                    </div>
                    <div class="col-lg-6 px-3 py-3">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="text" class="form-control" id="tanggal_transaksi" readonly name="tanggal_transaksi" value="{{ date("d-m-Y")}}">
                    </div>
                </div>
                
            <table class="table table-hovered text-center table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Konsumen</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Obat</th>
                        <th>Harga</th>
                        <th>SubTotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>asdasdasdasdsd</td>
                        <td>asdasdasdasdsd</td>
                        <td>asdasdasdasdsd</td>
                        <td>
                            asdasasd
                        </td>
                        <td>asdasasdsad</td>
                        <td>asdasasd</td>
                        <td>
                            <button type="submit" class="btn btn-danger text-white swal-delete" data-id="" title="Hapus data">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </td>
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
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).on('click', '.swal-delete', function(e){
        e.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Hapus?',
            text: "Data tidak akan bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/kategori') }}/" + id,
                    data: {
                        _method: "DELETE"
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Data berhasil dihapus.",
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
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        })
    });
</script>
@endpush