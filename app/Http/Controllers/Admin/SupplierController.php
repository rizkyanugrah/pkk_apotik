<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use File;
use App\Http\Controllers\Helper\UploadController;

class SupplierController extends Controller
{
    private $helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->helpers = new UploadController();
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.index', compact('suppliers'));
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
        $location = 'images/supplier/';

        $suppliers = new Supplier();
        $suppliers->nama_supplier = $request->get('nama_supplier');
        $suppliers->alamat = $request->get('alamat');
        $suppliers->nomor_handphone = $request->get('no_hp');
        $suppliers->gambar = $this->helpers->imageUpload($image, $location);
        $suppliers->save();
        return redirect()->route('admin.supplier.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        return view('admin.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('admin.supplier.edit', compact('supplier'));
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
        $location = 'images/supplier/';
        $supplier = Supplier::find($id);

        if (!empty($image)) {
            if (File::exists($supplier->gambar)) {
                File::delete($supplier->gambar);
            }
        }

        if ($image !== null) {
            $supplier->gambar = $this->helpers->imageUpload($image, $location);
        }

        $supplier->nama_supplier = $request->get('nama_supplier') ?? $supplier->supplier;
        $supplier->alamat = $request->get('alamat') ?? $supplier->alamat;
        $supplier->nomor_handphone = $request->get('no_hp') ?? $supplier->nomor_handphone;

        $supplier->save();

        return redirect()->route('admin.supplier.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::find($id)->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'Data berhasil dihapus!');
    }
}
