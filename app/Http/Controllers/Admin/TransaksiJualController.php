<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\transaksi_penjualan;
use App\TransaksiPenjualan;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat_keluar.transaksi.indexs', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            foreach ($request->obat as $obat) {
                $obat_data = Obat::find($obat['obat']);
                $transaksi_penjualan = new TransaksiPenjualan();
                $transaksi_penjualan->user_id = Auth::user()->id;
                $transaksi_penjualan->obat_id = $obat['obat'];
                $transaksi_penjualan->nama_pembeli = $request->name;
                $transaksi_penjualan->total_obat = $obat['jumlah'];
                $transaksi_penjualan->sub_total = $obat_data->harga_jual * intval($obat['jumlah']);
                $transaksi_penjualan->tanggal_transaksi = Carbon::parse($request->tanggal_transaksi)->toDateTimeString();
                $transaksi_penjualan->save();
            }

            return response()->json(['status' => 200, 'message' => 'Transaksi Berhasil'], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => [$e->getMessage()]], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
