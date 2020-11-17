<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\Supplier;
use File;
use App\Http\Controllers\Helper\UploadController;

class ObatController extends Controller
{
    private $helpers;

    /**
     * Constructor.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->helpers = new UploadController();
    }

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
        $image = $request->file('gambar');
        $location = 'images/obat/';

        $obats = new Obat();
        $obats->supplier_id = $request->get('supplier');
        $obats->nama_obat = $request->get('nama_obat');
        $obats->aturan_minum = $request->get('aturan_minum');
        $obats->satuan = $request->get('satuan');
        $obats->harga = $request->get('harga');
        $obats->expired = date('Y-m-d', strtotime($request->get('expired')));
        $obats->gambar = $this->helpers->imageUpload($image, $location);
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
        $image = $request->file('gambar');
        $location = 'images/obat/';
        $medicine = Obat::find($id);

        if (!empty($image)) {
            if (File::exists($medicine->gambar)) {
                File::delete($medicine->gambar);
            }
        }

        if ($image !== null) {
            $medicine->gambar = $this->helpers->imageUpload($image, $location);
        }

        $medicine->supplier_id = $request->get('supplier') ?? $medicine->supplier;
        $medicine->nama_obat = $request->get('nama_obat') ?? $medicine->nama_obat;
        $medicine->aturan_minum = $request->get('aturan_minum') ?? $medicine->aturan_minum;
        $medicine->satuan = $request->get('satuan') ?? $medicine->satuan;
        $medicine->harga = $request->get('harga') ?? $medicine->harga;
        $medicine->expired = date('Y-m-d', strtotime($request->get('expired'))) ?? $medicine->expired;
        $medicine->save();

        return redirect()->route('admin.obat.index')->with('success', 'Data berhasil diubah!');
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
