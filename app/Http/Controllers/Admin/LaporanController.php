<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Obat;
use App\TransaksiPembelian;
use App\TransaksiPenjualan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.laporan.index');
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
    private function exportDrugsData()
    {
        $drugs = Obat::all();
        $column_alphanumerics = range('A', 'K');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->setActiveSheetIndex(0);

        foreach ($column_alphanumerics as $column_alphanumeric) {
            $sheet->setCellValue('A1', 'NO')
                ->setCellValue('B1', 'Nama Obat')
                ->setCellValue('C1', 'Satuan')
                ->setCellValue('D1', 'Jenis')
                ->setCellValue('E1', 'Kategori')
                ->setCellValue('F1', 'Aturan Minum')
                ->setCellValue('G1', 'Indikasi')
                ->setCellValue('H1', 'Harga Beli')
                ->setCellValue('I1', 'Harga Jual')
                ->setCellValue('J1', 'Stok')
                ->setcellvalue('K1', 'Terakhir Diubah')->getColumnDimension($column_alphanumeric)->setAutoSize(true);
        }

        $column = 2;
        $number = 1;
        foreach ($drugs as $key => $drug) {
            $sheet->setCellValue('A' . $column, $number)
                ->setCellValue('B' . $column, $drug->nama_obat)
                ->setCellValue('C' . $column, $drug->satuans->nama_satuan)
                ->setCellValue('D' . $column, $drug->jenis->nama_jenis)
                ->setCellValue('E' . $column, $drug->kategoris->nama_kategori)
                ->setCellValue('F' . $column, $drug->aturan_minum)
                ->setCellValue('G' . $column, $drug->indikasi)
                ->setCellValue('H' . $column, "Rp. " . number_format($drug->harga_beli, 0, ',', '.'))
                ->setCellValue('I' . $column, "Rp. " . number_format($drug->harga_jual, 0, ',', '.'))
                ->setCellValue('J' . $column, $drug->stok)
                ->setCellValue('K' . $column, Carbon::parse($drug->updated_at)->format("d-m-Y"))->getColumnDimension($column_alphanumeric)->setAutoSize(true);
            $column++;
            $number++;
        }

        $file_name = '[APOTEK] - DAFTAR OBAT -' . date('d-m-Y');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');

        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }

    private function exportSellData($start_date, $end_date)
    {
        $transactions = TransaksiPenjualan::whereBetween('tanggal_penjualan', [Carbon::parse($start_date)->toDateTimeString(), Carbon::parse($end_date)->toDateTimeString()])->get();
        $column_alphanumerics = range('A', 'G');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->setActiveSheetIndex(0);

        foreach ($column_alphanumerics as $column_alphanumeric) {
            $sheet->setCellValue('A1', 'NO')
                ->setCellValue('B1', 'Nama Apoteker')
                ->setCellValue('C1', 'Nama Pembeli')
                ->setCellValue('D1', 'Tanggal Penjualan')
                ->setCellValue('E1', 'Total Harga')
                ->setCellValue('F1', 'Daftar Obat')
                ->setCellValue('G1', 'Daftar Kuantitas Obat')->getColumnDimension($column_alphanumeric)->setAutoSize(true);
        }

        $column = 2;
        $number = 1;
        foreach ($transactions as $key => $transaction) {
            $drug_list = join(", ", $transaction->details->map(function ($detail) {
                return $detail->obat->nama_obat;
            })->toArray());
            $drug_quantity_list = join(", ", $transaction->details->map(function ($detail) {
                return $detail->total_obat . " " . $detail->obat->satuans->nama_satuan;
            })->toArray());
            $sheet->setCellValue('A' . $column, $number)
                ->setCellValue('B' . $column, $transaction->user->name)
                ->setCellValue('C' . $column, $transaction->nama_pembeli)
                ->setCellValue('D' . $column, Carbon::parse($transaction->tanggal_penjualan)->format("d-m-Y"))
                ->setCellValue('E' . $column, $transaction->cost)
                ->setCellValue('F' . $column, $drug_list)
                ->setCellValue('G' . $column, $drug_quantity_list)->getColumnDimension($column_alphanumeric)->setAutoSize(true);
            $column++;
            $number++;
        }

        $file_name = '[APOTEK] - DAFTAR TRANSAKSI PENJUALAN -' . date('d-m-Y');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');

        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }

    private function exportBoughtData($start_date, $end_date)
    {
        $transactions = TransaksiPembelian::whereBetween('tanggal_pembelian', [Carbon::parse($start_date)->toDateTimeString(), Carbon::parse($end_date)->toDateTimeString()])->get();
        $column_alphanumerics = range('A', 'G');

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->setActiveSheetIndex(0);

        foreach ($column_alphanumerics as $column_alphanumeric) {
            $sheet->setCellValue('A1', 'NO')
                ->setCellValue('B1', 'Nama Apoteker')
                ->setCellValue('C1', 'Supplier')
                ->setCellValue('D1', 'Tanggal Pembelian')
                ->setCellValue('E1', 'Total Harga')
                ->setCellValue('F1', 'Daftar Obat')
                ->setCellValue('G1', 'Daftar Kuantitas Obat')->getColumnDimension($column_alphanumeric)->setAutoSize(true);
        }

        $column = 2;
        $number = 1;
        foreach ($transactions as $key => $transaction) {
            $drug_list = join(", ", $transaction->details->map(function ($detail) {
                return $detail->obat->nama_obat;
            })->toArray());
            $drug_quantity_list = join(", ", $transaction->details->map(function ($detail) {
                return $detail->total_obat . " " . $detail->obat->satuans->nama_satuan;
            })->toArray());
            $sheet->setCellValue('A' . $column, $number)
                ->setCellValue('B' . $column, $transaction->user->name)
                ->setCellValue('C' . $column, $transaction->supplier->nama_supplier)
                ->setCellValue('D' . $column, Carbon::parse($transaction->tanggal_pembelian)->format("d-m-Y"))
                ->setCellValue('E' . $column, $transaction->cost)
                ->setCellValue('F' . $column, $drug_list)
                ->setCellValue('G' . $column, $drug_quantity_list)->getColumnDimension($column_alphanumeric)->setAutoSize(true);
            $column++;
            $number++;
        }

        $file_name = '[APOTEK] - DAFTAR TRANSAKSI PEMBELIAN -' . date('d-m-Y');
        header('Content-Disposition: attachment;filename="' . $file_name . '.xls"');

        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->type) {
            case "obat":
                $this->exportDrugsData();
                break;
            case "pembelian":
                $this->exportBoughtData($request->start_date, $request->end_date);
                break;
            case "penjualan":
                $this->exportSellData($request->start_date, $request->end_date);
                break;
            default:
                return redirect()->route('admin.laporan.index')->with('error', 'Gagal mendownload laporan!');
        }


        return redirect()->route('admin.laporan.index');
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
        //
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
