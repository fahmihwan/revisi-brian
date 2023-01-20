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
            return Receiving::selectRaw("sum(target_qty) as qty, month(date) as month ")
                ->whereMonth('date', $month)
                ->whereYear('date', date('Y'))
                ->groupBy('month')
                ->first();
        }


        function sumIssuing($month)
        {
            return Detail_Issuing::selectRaw('sum(qty) as qty, month(date) as month')
                ->join('issuings', 'detail_issuings.issuing_id', '=', 'issuings.id')
                ->groupBy('month')
                ->whereMonth('date', $month)
                ->whereYear('date', date('Y'))
                ->first();
        }

        $orders = []; //value 12 month of year, etc : 0,0,0,0,12,23,0,0,0 dst until 12 array data
        $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $orders[] = sumReceiving($i) != null ? sumReceiving($i)->qty : 0;
            $sales[] = sumIssuing($i) != null ? sumIssuing($i)->qty : 0;
        }

        $total_sales = Detail_Issuing::selectRaw('sum(qty) as qty, year(date) as year')
            ->join('issuings', 'detail_issuings.issuing_id', '=', 'issuings.id')
            ->groupBy('year')
            ->whereYear('date', date('Y'))
            ->first();

        $total_order = Receiving::selectRaw("sum(target_qty) as qty, year(date) as year ")
            ->whereYear('date', date('Y'))
            ->groupBy('year')
            ->first();


        $sales_today = Issuing::with([
            'detail_issuings.item.category_brand',
            'detail_issuings.item.category_product',
            'customer'
        ])
            ->where('date', date('Y-m-d'))
            ->get();

        // top 8 max item
        $top_max_items =  Item::with('category_product:id,name')->orderBy('qty', 'desc')->limit(8)->get();

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
