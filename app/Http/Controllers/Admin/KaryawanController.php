<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Foundation\Auth\User;
use File;
use App\Http\Controllers\Helper\UploadController;

class KaryawanController extends Controller
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
        $karyawans = User::all();
        $roles = Role::all();
        return view('admin.karyawan.index', compact('karyawans', 'roles'));
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
        $location = 'images/karyawan/';
        $password = $request->get('password');
        $pass = bcrypt($password);

        $karyawans = new User();
        $karyawans->name = $request->get('nama_karyawan');
        $karyawans->email = $request->get('email');
        $karyawans->alamat = $request->get('alamat');
        $karyawans->no_telp = $request->get('no_telp');
        $karyawans->role_id = $request->get('role');
        $karyawans->jenis_kelamin = $request->get('jenis_kelamin');
        $karyawans->password = $pass;
        $karyawans->gambar = $this->helpers->imageUpload($image, $location);
        $karyawans->save();

        return redirect()->route('admin.karyawan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $karyawan = User::find($id);
        $karyawan->role = Role::find($karyawan->role_id);
        return view('admin.karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = User::find($id);
        return view('admin.karyawan.edit', compact('karyawan'));
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
        $location = 'images/karyawan/';
        $karyawan = User::find($id);

        if (!empty($image)) {
            if (File::exists($karyawan->gambar)) {
                File::delete($karyawan->gambar);
            }
        }

        if ($image !== null) {
            $karyawan->gambar = $this->helpers->imageUpload($image, $location);
        }

        $karyawan->name = $request->get('nama_karyawan') ?? $karyawan->name;
        $karyawan->email = $request->get('email') ?? $karyawan->email;
        $karyawan->jenis_kelamin = $request->get('jk') ?? $karyawan->jenis_kelamin;
        $karyawan->alamat = $request->get('alamat') ?? $karyawan->alamat;
        $karyawan->no_telp = $request->get('no_telp') ?? $karyawan->no_telp;
        $karyawan->save();

        return redirect()->route('admin.karyawan.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('admin.karyawan.index')->with('success', 'Data berhasil dihapus!');
    }
}
