<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\Supplier;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicines = Obat::all();
        $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();

        return view('admin.obat.index', compact('medicines', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obats = new Obat();
        $obats->supplier_id = $request->get('supplier');
        $obats->nama_obat = $request->get('nama_obat');
        $obats->aturan_minum = $request->get('aturan_minum');
        $obats->satuan = $request->get('satuan');
        $obats->harga = $request->get('harga');
        $obats->expired = date('Y-m-d', strtotime($request->get('expired')));
        $obats->save();

        return redirect()->route('admin.obat.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicine = Obat::find($id);

        return view('admin.obat.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = Obat::find($id);
        $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();
        return view('admin.obat.edit', compact('medicine', 'suppliers'));
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
