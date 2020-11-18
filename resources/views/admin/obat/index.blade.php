@extends('layouts.stisla.index', ['title' => 'Daftar Obat', 'header' => 'Obat'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3 text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Tambah Data
                    </button>
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
                        <th>#</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Kadaluarsa</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $key => $medicine)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $medicine->nama_obat }}</td>
                        <td>{{ $medicine->satuans->nama_satuan }}</td>
                        <td>
                            <span class="badge badge-pill text-uppercase badge-{{ $medicine->is_expired === 1 ? 'danger' : 'success' }}" data-toggle="tooltip" data-placement="top" title="{{ is_expired($medicine) }}">{{ is_expired($medicine) }}</span>
                        </td>
                        <td class="{{ $medicine->tanggal_kadaluarsa <= date('Y-m-d') ? 'text-danger font-weight-bold' : '' }}">{{ indonesian_date($medicine->tanggal_kadaluarsa) }}</td>
                        <td>{{ $medicine->suppliers->nama_supplier }}</td>
                        <td>{{ $medicine->stok }}</td>
                        <td>
                            <a href="{{ route('admin.obat.show', $medicine->id) }}" class="btn btn-sm btn-info text-white" title="Lihat data">
                                <i class="fas fa-fw fa-search"></i>
                            </a>
                            <a href="{{ route('admin.obat.edit', $medicine->id) }}" class="btn btn-sm btn-warning text-white" title="Ubah data">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-sm btn-danger text-white swal-delete" data-id="{{ $medicine->id }}" title="Hapus data">
                                <i class="fas fa-fw fa-trash"></i>
                            </button>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                    url: "{{ url('admin/obat') }}/" + id,
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

@push('modal')
@include('admin.obat.modal.create')
@endpush