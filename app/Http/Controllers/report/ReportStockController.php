<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\Item;


use PDF;

class ReportStockController extends Controller
{

    public function index()
    {

        $item = Item::with(['kategori_brand', 'kategori_produk'])->get();
        return view('pages.report.stock.index', [
            'items' => $item
        ]);
    }

    public function print_first($id)
    {
        $item = Item::with(['kategori_brand', 'kategori_produk'])
            ->where('id', $id)->first();

        $pdf = PDF::loadview('pages.report.stock.print_first', [
            'item' => $item
        ]);
        return $pdf->download('laporan-stok-pdf');
    }



    public function print_stock()
    {
        $item = Item::with(['kategori_brand', 'kategori_produk'])->get();

        // return view('pages.report.stock.print', [
        //     'items' => $item
        // ]);
        $pdf = PDF::loadview('pages.report.stock.print', [
            'items' => $item
        ]);

        return $pdf->download('laporan-stok-pdf');
    }
}
