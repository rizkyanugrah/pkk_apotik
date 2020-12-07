@extends('layouts.stisla.index', ['title' => 'Halaman Dashboard','header' => 'Dashboard - ' . auth()->user()->name])

@section('content')
<div class="row">
    @if(auth()->user()->role_id === 1)
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <a href="#">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user ml-0"></i>
                    </div>
                </a>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Karyawan</h4>
                    </div>
                    <div class="card-body">
                        {{ count($karyawan) }}
                    </div>
                </div>
            </div>
        </div>
    @endif        
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <a href="{{ route('admin.obat.index') }}">
                <div class="card-icon bg-danger">
                    <i class="fas fa-th-large ml-0"></i>
                </div>
            </a>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Obat Kadaluarsa</h4>
                </div>
                <div class="card-body">
                    {{ count($obat_kadaluarsa) }}
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <a href="{{ route('admin.obat.index') }}">
                <div class="card-icon bg-success">
                    <i class="fas fa-th-large ml-0"></i>
                </div>
            </a>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Obat Tidak Kadaluarsa</h4>
                </div>
                <div class="card-body">
                    {{ count($obat_tidak_kadaluarsa) }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <a href="{{ route('admin.obat.index') }}">
                <div class="card-icon bg-primary">
                    <i class="fas fa-th-large ml-0"></i>
                </div>
            </a>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Obat</h4>
                </div>
                <div class="card-body">
                    {{ count($obat) }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <a href="{{ route('admin.obat.index') }}">
                <div class="card-icon bg-warning">
                    <i class="fas fa-th-large ml-0"></i>
                </div>
            </a>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Obat Hampir Habis</h4>
                </div>
                <div class="card-body">
                    {{ count($stok) }}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <ds --}}
@endsection