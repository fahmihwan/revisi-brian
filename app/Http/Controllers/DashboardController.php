<?php

namespace App\Http\Controllers;

use App\Models\Detail_Issuing;
use App\Models\Issuing;
use App\Models\Item;
use App\Models\Receiving;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Isset_;

class DashboardController extends Controller
{

    public function index()
    {


        // With locale
        // Carbon\Carbon::parse('2019-03-01')->translatedFormat('d F Y'); //Output: "01 Maret 2019"
        function sumReceiving($month)
        {
            return Receiving::selectRaw("sum(target_qty) as qty, month(tanggal) as month ")
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', date('Y'))
                ->groupBy('month')
                ->first();
        }


        function sumIssuing($month)
        {
            return Detail_Issuing::selectRaw('sum(qty) as qty, month(tanggal) as month')
                ->join('barang_keluars', 'detail_barang_keluars.barang_keluar_id', '=', 'barang_keluars.id')
                ->groupBy('month')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', date('Y'))
                ->first();
        }

        $orders = []; //value 12 month of year, etc : 0,0,0,0,12,23,0,0,0 dst until 12 array data
        $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $orders[] = sumReceiving($i) != null ? sumReceiving($i)->qty : 0;
            $sales[] = sumIssuing($i) != null ? sumIssuing($i)->qty : 0;
        }


        $total_sales = Detail_Issuing::selectRaw('sum(qty) as qty, year(tanggal) as year')
            ->join('barang_keluars', 'detail_barang_keluars.barang_keluar_id', '=', 'barang_keluars.id')
            ->groupBy('year')
            ->whereYear('tanggal', date('Y'))
            ->first();

        $total_order = Receiving::selectRaw("sum(target_qty) as qty, year(tanggal) as year ")
            ->whereYear('tanggal', date('Y'))
            ->groupBy('year')
            ->first();

        $sales_today = Issuing::with([
            'detail_barang_keluars.item.kategori_brand',
            'detail_barang_keluars.item.kategori_produk',
            'customer'
        ])
            ->where('tanggal', date('Y-m-d'))
            ->get();

        // top 8 max item
        $top_max_items =  Item::with('kategori_produk:id,nama')->orderBy('qty', 'desc')->limit(8)->get();

        return view('pages.dashboard.index', [
            'orders' => $orders,
            'sales' => $sales,
            'total_sales' => empty($total_sales->qty) ? 0 : $total_sales->qty,
            'total_orders' => empty($total_order->qty) ? 0 : $total_order->qty,
            'sales_today' => $sales_today,
            'top_max_item' => $top_max_items
        ]);
    }
}
