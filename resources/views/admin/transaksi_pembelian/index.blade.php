@extends('layouts.stisla.index', ['title' => 'Transaksi Penjualan', 'header' => 'Transaksi Penjualan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3 text-right">
                    <a href="{{ route('admin.pembelian.create') }}" type="button" class="btn btn-primary">
                        + Transaksi Baru
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
            <table class="table table-hovered text-center table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Apoteker</th>
                        <th>Supplier</th>
                        <th>Total Biaya</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$transaction->user->name}}</td>
                        <td>{{$transaction->supplier->nama_supplier}}</td>
                        <td>{{$transaction->cost}}</td>
                        <td>{{$transaction->transaction_date}}</td>
                        <td>
                            <a href="{{ route('admin.pembelian.show', $transaction->id) }}" class="btn btn-sm btn-info text-white" title="Lihat data">
                                <i class="fas fa-fw fa-search"></i>
                            </a>
                            @if(auth()->user()->role_id === 1)
                            <a href="{{ route('admin.pembelian.edit', $transaction->id) }}" class="btn btn-sm btn-warning text-white" title="Ubah data">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-danger text-white swal-delete" data-id="{{ $transaction->id }}" title="Hapus data">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).on('click', '.swal-delete', function(e) {
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
                    url: "{{ url('admin/pembelian') }}/" + id,
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
                        Swal.fire({
                            title: "Gagal",
                            text: request.responseJSON.errors,
                            icon: "error",
                        }).then(function() {
                            location.reload();
                        })
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection