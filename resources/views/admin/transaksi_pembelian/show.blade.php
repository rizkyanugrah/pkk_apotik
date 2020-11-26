@extends('layouts.stisla.index', ['title' => 'Detail Transaksi Pembelian #' . $transaction->id, 'header' => 'Detail Transaki Pembelian #' . $transaction->id])

@section('content')
<div class="row">
    <div class=" col-12">
        <div class="card">
            <table class="table">
                <tr>
                    <td style="width: 200px;">Apoteker Penerima</td>
                    <td style="width: 10px;">:</td>
                    <td class="text-wrap">{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <td>Supplier</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $transaction->supplier->nama_supplier }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pembelian</td>
                    <td>:</td>
                    <td class="text-wrap">{{ $transaction->transaction_date }}</td>
                </tr>
                <tr>
                    <td>Total Biaya</td>
                    <td>:</td>
                    <td class="text-wrap">
                        <b>{{ $transaction->cost }}</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card">
            <div class="card-header">
                <h5>Detail Pembelian</h5>
            </div>
            <div class="card-body">
                <table class="table table-hovered text-center table-bordered" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Harga Beli</th>
                            <th>Jumlah Obat</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->details as $key => $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.obat.show', $detail->obat->id) }}">{{ $detail->obat->nama_obat }}</a>
                            </td>
                            <td>Rp. {{ number_format($detail->obat->harga_beli, 0, ',', '.') }}</td>
                            <td>{{ $detail->total_obat }}</td>
                            <td>{{ $detail->cost }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection