<?php

namespace App\Http\Controllers;

use App\Obat;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = User::all();
        $obat_kadaluarsa = Obat::where('is_expired', 1)->get();
        $obat_tidak_kadaluarsa = Obat::where('is_expired', 0)->get();

        return view('admin.dashboard.index', compact('karyawan', 'obat_kadaluarsa', 'obat_tidak_kadaluarsa'));
    }
}
