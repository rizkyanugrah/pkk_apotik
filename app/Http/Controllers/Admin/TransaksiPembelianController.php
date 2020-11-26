<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\TransaksiPembelian;
use App\TransaksiPembelianDetail;
use App\Supplier;
use App\Obat;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransaksiPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransaksiPembelian::all();
        return view('admin.transaksi_pembelian.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $obats = Obat::all();
        return view('admin.transaksi_pembelian.create', compact('suppliers', 'obats'));
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
            $transaction = new TransaksiPembelian();
            $transaction->tanggal_pembelian = Carbon::parse($request->transaction_date)->toDateTimeString();
            $transaction->user_id = auth()->user()->id;
            $transaction->supplier_id = $request->supplier;
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
                $transaction_detail = new TransaksiPembelianDetail();
                $transaction_detail->obat_id = $detail['id'];
                $transaction_detail->total_obat = intval($detail['total']);
                $transaction_detail->transaksi_pembelian_id = $transaction->id;
                $transaction_detail->save();
                $drug->stok = $drug->stok - intval($detail['total']);
                $drug->update();
            }
            return response()->json([
                "status" => 200,
                "message" => "Berhasil menambah transaksi pembelian"
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
        $transaction = TransaksiPembelian::findOrFail($id);
        return view('admin.transaksi_pembelian.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = Supplier::all();
        $obats = Obat::all();
        $transaction = TransaksiPembelian::findOrFail($id);
        return view('admin.transaksi_pembelian.edit', compact('suppliers', 'obats', 'transaction'));
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
        $transaction = TransaksiPembelian::findOrFail($id);
        $transaction->tanggal_pembelian = Carbon::parse($request->transaction_date)->toDateTimeString();
        $transaction->supplier_id = $request->supplier;
        $transaction->update();
        //  Return drug stock to normal (before transaction)
        foreach ($transaction->details as $detail) {
            $drug = Obat::find($detail->obat_id);
            $drug->stok = $drug->stok + $detail->total_obat;
            $drug->update();
            $detail->delete();
        }
        foreach ($request->details as $detail) {
            $drug = Obat::find($detail['id']);
            if ($drug->stok < $detail['total']) {
                return response()->json([
                    "status" => 200,
                    "errors" => "Stok Obat $drug->nama_obat Tidak Mencukupi!"
                ], 200);
                $transaction->delete();
            }
            $transaction_detail = new TransaksiPembelianDetail();
            $transaction_detail->obat_id = $detail['id'];
            $transaction_detail->total_obat = intval($detail['total']);
            $transaction_detail->transaksi_pembelian_id = $transaction->id;
            $transaction_detail->save();
            $drug->stok = $drug->stok - intval($detail['total']);
            $drug->update();
        }
        return response()->json([
            "status" => 200,
            "message" => "Berhasil menambah transaksi pembelian"
        ], 200);
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
            $transaction = TransaksiPembelian::findOrFail($id);
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
