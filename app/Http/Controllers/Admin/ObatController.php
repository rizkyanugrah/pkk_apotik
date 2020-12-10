<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\Supplier;
use File;
use App\Http\Controllers\Helper\UploadController;
use App\Jenis;
use App\Kategori;
use App\Satuan;
use NumberFormatter;

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
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
        $jeniss     = Jenis::orderBy('nama_jenis', 'asc')->get();
        $satuans   = Satuan::orderBy('nama_satuan', 'asc')->get();

        return view('admin.obat.index', compact('medicines', 'suppliers', 'kategoris', 'jeniss', 'satuans'));
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



        $harga_jual = intval(preg_replace('(\D+)', '', $request->get('harga_jual')));
        $harga_beli = intval(preg_replace('(\D+)', '', $request->get('harga_beli')));

        $obats = new Obat();
        $obats->supplier_id = $request->get('supplier');
        $obats->satuan_id = $request->get('satuan');
        $obats->jenis_id = $request->get('jenis');
        $obats->kategori_id = $request->get('kategori');
        $obats->indikasi = $request->get('indikasi');
        $obats->harga_jual = $harga_jual;
        $obats->harga_beli = $harga_beli;
        $obats->stok = 0;
        $obats->nama_obat = $request->get('nama_obat');
        $obats->aturan_minum = $request->get('aturan_minum');
        $obats->is_expired = $request->get('is_expired');
        $obats->tanggal_kadaluarsa = $request->get('tanggal_kadaluarsa');
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
        $kategoris = Kategori::orderBy('nama_kategori', 'asc')->get();
        $jeniss     = Jenis::orderBy('nama_jenis', 'asc')->get();
        $satuans   = Satuan::orderBy('nama_satuan', 'asc')->get();
        return view('admin.obat.edit', compact('medicine', 'suppliers', 'kategoris', 'jeniss', 'satuans'));
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

        $harga_jual = intval(preg_replace('(\D+)', '', $request->get('harga_jual')));
        $harga_beli = intval(preg_replace('(\D+)', '', $request->get('harga_beli')));

        $medicine->supplier_id = $request->get('supplier') ?? $medicine->supplier;
        $medicine->satuan_id = $request->get('satuan') ?? $medicine->satuan;
        $medicine->kategori_id = $request->get('kategori') ?? $medicine->kategori;
        $medicine->jenis_id = $request->get('jenis') ?? $medicine->jenis;
        $medicine->stok = $request->get('stok') ?? $medicine->stok;
        $medicine->indikasi = $request->get('indikasi') ?? $medicine->indikasi;
        $medicine->nama_obat = $request->get('nama_obat') ?? $medicine->nama_obat;
        $medicine->aturan_minum = $request->get('aturan_minum') ?? $medicine->aturan_minum;
        $medicine->harga_beli = $harga_beli ?? $medicine->harga_beli;
        $medicine->harga_jual = $harga_jual ?? $medicine->harga_jual;
        $medicine->is_expired = $request->get('is_expired') ?? $medicine->is_expired;
        $medicine->tanggal_kadaluarsa = $request->get('tanggal_kadaluarsa') ?? $medicine->tanggal_kadaluarsa;
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
        Obat::find($id)->delete();
        return redirect()->route('admin.obat.index')->with('success', 'Data berhasil dihapus!');
    }

    public function addToCart($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            abort(404);
        }
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [
                $id => [
                    "apotaker" => $obat->apotaker,
                    "name" => $obat->name,
                    "quantity" => $obat->jumlah,
                    'price' => $obat->harga_jual,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->route('admin.obat.index')->with('success', 'Product added to cart successfully!');
        }
    }
}
