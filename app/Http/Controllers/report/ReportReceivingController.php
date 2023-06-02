<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Receiving;
use Barryvdh\DomPDF\Facade\Pdf;
use Dflydev\DotAccessData\Data;

class ReportReceivingController extends Controller
{
    public function index()
    {
        // print
        if (request('print')) {
            $data = Receiving::latest()->filter(request(['start_date', 'end_date']));
            if ($data->count() == 0) {
                return redirect('/report/receiving')->withErrors('Data tanggal ' . request('start_date') . ' sampai ' . request('end_date') . ' tidak ada');
            }

            $pdf = Pdf::loadView('pages.report.receiving.print_date', [
                'datas' => $data->get()
            ]);
            return $pdf->download('report_receiving.pdf');
        }

        // search
        if (request('start_date')) {
            $data = Receiving::latest()->filter(request(['start_date', 'end_date']))->get();
        } else {
            $data = Receiving::with(['supplier:id,nama', 'kategori_produk:id,nama'])->get();
        }

        return view('pages.report.receiving.index', [
            'datas' => $data,
        ]);
    }


    public function print_first($id)
    {
        $data = Receiving::with(['supplier:id,nama', 'kategori_produk:id,nama'])
            ->where('id', $id)->first();


        $pdf = PDF::loadview('pages.report.receiving.print_first', [
            'item' => $data
        ]);

        return $pdf->download('laporan-receiving-pdf.pdf');
    }
}
