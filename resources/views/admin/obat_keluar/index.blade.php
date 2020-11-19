@extends('layouts.stisla.index', ['title' => 'Transaksi Penjualan', 'header' => 'Transaksi Penjualan'])

@section('content')
<div class="row">
    <div class="col-lg-12 table-responsive">
        <div class="card px-3 py-3">
            <div class="row">
                <div class="col-lg-12 px-3 py-3 text-right">
                    <a href="{{ route('admin.transaksi_jual.index') }}" type="button" class="btn btn-primary">
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
                        <th>Nama Konsumen</th>
                        <th>Pembelian Obat</th>
                        <th>Total Obat</th>
                        <th>Status Pembelian</th>
                        <th>Tanggal Transaksi</th>
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
                            <a href="#" class="btn btn-sm btn-info text-white" title="Lihat data">
                                <i class="fas fa-fw fa-search"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-warning text-white" title="Ubah data">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection