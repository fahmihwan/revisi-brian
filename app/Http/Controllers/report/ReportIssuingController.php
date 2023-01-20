<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Issuing;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportIssuingController extends Controller
{
    public function index()
    {

        // print
        if (request('print')) {
            $data = Issuing::latest()->filter(request(['start_date', 'end_date']));

            if ($data->count() == 0) {
                return redirect('/report/issuing')->withErrors('Data tanggal ' . request('start_date') . ' sampai ' . request('end_date') . ' tidak ada');
            }
            $pdf = Pdf::loadView('pages.report.issuing.print_date', [
                'items' => $data->get()
            ]);
            return $pdf->download('report_issuing.pdf');
        }

        // search
        if (request('start_date')) {
            $data = Issuing::latest()->filter(request(['start_date', 'end_date']))->get();
        } else {
            $data = Issuing::with(['detail_barang_keluars.item.kategori_brand', 'detail_barang_keluars.item.kategori_produk', 'customer'])->get();
        }


        return view('pages.report.issuing.index', [
            'datas' => $data
        ]);
    }
    public function print_first($id)
    {

        $data =  Issuing::with(['detail_barang_keluars.item.kategori_brand', 'detail_barang_keluars.item.kategori_produk', 'customer'])
            ->where('id', $id)->first();

        $pdf = PDF::loadview('pages.report.issuing.print_first', [
            'item' => $data
        ]);

        return $pdf->download('laporan-issuing-pdf');
    }
}
