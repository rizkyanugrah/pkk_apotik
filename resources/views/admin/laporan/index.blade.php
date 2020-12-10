@extends('layouts.stisla.index', ['title' => 'Laporan', 'header' => 'Laporan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session()->get('success') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{ route('admin.laporan.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="type">Data Laporan</label>
                            <select name="type" class="form-control" id="type">
                                <option value="penjualan">Transaksi Penjualan</option>
                                <option selected value="pembelian">Transaksi Pembelian</option>
                                <option value="obat">Daftar Obat</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" class="form-control datepicker" name="start_date" id="start_date">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label for="end_date">Tanggal Terakhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="col-lg-12 px-3 py-3 text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-download mr-2"></i>Download Laporan
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@push('js')
<script>
    $(function() {
        $("form select[name='type']").on('change', function(e) {
            if (e.target.value === "obat") {
                $("form input[name='start_date']").attr('disabled', true)
                $("form input[name='end_date']").attr('disabled', true)
            } else {
                $("form input[name='start_date']").attr('disabled', false)
                $("form input[name='end_date']").attr('disabled', false)
            }
        })
    })
</script>
@endpush
@endsection