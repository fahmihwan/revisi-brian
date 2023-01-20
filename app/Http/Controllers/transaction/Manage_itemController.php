<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use App\Models\Category_brand;

// use App\Models\Detail_brand;
use App\Models\Item;
use App\Models\Manage_item;
use App\Models\Receiving;
// use Illuminate\Database\Capsule\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class Manage_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return view('pages.transaction.manage_item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'ball_number' => 'required',
            'category_product_id' => 'required|numeric',
            'name' => 'required|numeric',
            'open_qty' => 'required|numeric'
        ]);

        // item update nanti 
        $getItem = Item::where('category_product_id', '=', $request->category_product_id)
            ->where('id', '=', $request->name);

        if ($getItem->exists() == null) { //cek jika tidak ada
            return redirect()->back()->with('fail', 'Fail !!, Item Belum ada, mau menambahkan Item sekarang? <a href="/master/item/create"
            class="text-decoration-underline ">
            Ya, tambah Item Sekarang</a>');
        }
        // get open_qty from receiving 
        $get_receiving = Receiving::where('ball_number', $request->ball_number)->first();
        $current_open_qty_receiving = $get_receiving->open_qty;
        $current_open_qty_receiving += $request->open_qty;

        // cheack if open_qty is full
        if ($get_receiving->target_qty < $current_open_qty_receiving) {
            return redirect()->back()->with('fail', ' Fail !!, Open qty melebihi Target ');
        }
        ///update qty from item now
        $data_item = $getItem->first();
        $current_qty_item =  $data_item->qty;
        $current_qty_item += $request->open_qty;

        try {
            DB::beginTransaction();

            Receiving::where('ball_number', $request->ball_number)->update([
                'open_qty' => $current_open_qty_receiving,
            ]);

            Item::where('id', $data_item->id)->update([
                'qty' => $current_qty_item
            ]);

            Manage_item::create([
                'item_id' => $data_item->id,
                'receiving_id' => $get_receiving->id,
                'qty' => $request->open_qty
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->back()->with('success', 'berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $receiving = Receiving::with('category_product')
            ->where(['ball_number' => $id])->first();

        $get_id_from_receiving = $receiving->id;

        $manage_item = Manage_item::with(['item.category_brand'])
            ->where(['receiving_id' => $get_id_from_receiving])
            ->get();

        return view('pages.transaction.manage_item.index', [
            'manage_item' => $manage_item,
            'receiving' => $receiving,
        ]);
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
        $manage_item = Manage_item::where('id', $id)->first();
        $item = Item::where('id', $manage_item->item_id)->first();


        $current_qty_item = $item->qty;
        $current_qty_item -= $manage_item->qty;

        $receiving = Receiving::where('id', $manage_item->receiving_id)->first();
        $result = $receiving->open_qty - $manage_item->qty;

        try {
            DB::beginTransaction();

            // update receiving
            Receiving::where('id', $receiving->id)->update([
                'open_qty' => $result
            ]);

            // update item
            Manage_item::where('id', $manage_item->id)->delete();
            Item::where('id', $item->id)->update([
                'qty' => $current_qty_item,
            ]);


            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

        // update item qty
        return redirect()->back();
    }



    public function create_manage_receiving($ball_number)
    {

        $receiving =  Receiving::with(['category_product:id,name'])
            ->where('ball_number', $ball_number)->first();


        $items = Item::with('category_brand')->where('category_product_id', $receiving->category_product_id)->get();;
        // return $items;


        $category_brand = Category_brand::with(['items'])
            ->latest()->get();


        // return $items;
        return view('pages.transaction.manage_item.create', [
            'receiving' => $receiving,
            'category_brand' => $category_brand,
            'item_name' => $items,
        ]);
    }
}
