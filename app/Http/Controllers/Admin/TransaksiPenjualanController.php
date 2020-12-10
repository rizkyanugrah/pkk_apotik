<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\TransaksiPenjualan;
use App\TransaksiPenjualanDetail;
use Carbon\Carbon;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransaksiPenjualan::all();
        return view('admin.transaksi_penjualan.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obats = Obat::all();
        return view('admin.transaksi_penjualan.create', compact('obats'));
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
            $transaction = new TransaksiPenjualan();
            $transaction->tanggal_penjualan = Carbon::parse($request->transaction_date)->toDateTimeString();
            $transaction->user_id = auth()->user()->id;
            $transaction->nama_pembeli = $request->pembeli;
            $transaction->save();
            foreach ($request->details as $detail) {
                $drug = Obat::find($detail['id']);
                if ($drug->stok < $detail['total']) {
                    return response()->json([
                        "status" => 400,
                        "errors" => "Stok Obat $drug->nama_obat Tidak Mencukupi!"
                    ], 400);
                    $transaction->delete();
                }
                $transaction_detail = new TransaksiPenjualanDetail();
                $transaction_detail->obat_id = $detail['id'];
                $transaction_detail->total_obat = intval($detail['total']);
                $transaction_detail->transaksi_penjualan_id = $transaction->id;
                $transaction_detail->save();
                $drug->stok = $drug->stok - intval($detail['total']);
                $drug->update();
            }
            return response()->json([
                "status" => 200,
                "message" => "Berhasil menambah transaksi Penjualan"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 400,
                "errors" => $e->getMessage()
            ], 400);
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
        $transaction = TransaksiPenjualan::findOrFail($id);
        return view('admin.transaksi_penjualan.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obats = Obat::all();
        $transaction = TransaksiPenjualan::findOrFail($id);
        return view('admin.transaksi_penjualan.edit', compact('obats', 'transaction'));
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
        try {
            $transaction = TransaksiPenjualan::findOrFail($id);
            $transaction->delete();
            return response()->json([
                "status" => 200,
                "message" => "Berhasil menghapus pembelian"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 400,
                "errors" => $e->getMessage()
            ], 400);
        }
    }
}
