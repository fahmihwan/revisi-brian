<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use App\Models\Detail_Issuing;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Detail_issuingController extends Controller
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


        $valdated = $request->validate([
            // 'category_product_id' => 'required|numeric',
            'item_id' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);


        $item = Item::where('id', $valdated['item_id'])->first();
        $currentItem = $item->qty - $valdated['qty'];

        if ($currentItem < 0) {
            return redirect()->back()->with('fail', 'stock tidak cukup');
        }

        try {
            DB::beginTransaction();
            Item::where('id', $valdated['item_id'])->update([
                'qty' => $currentItem
            ]);

            Detail_Issuing::create([
                'barang_keluar_id' => 0,
                'item_id' => $valdated['item_id'],
                'qty' => $valdated['qty'],
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->back();
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
        $detail_issuing = Detail_Issuing::where('id', $id)->first();
        $currentQty = $detail_issuing->qty;
        $item = Item::where('id', $detail_issuing->item_id)->first();
        $currentQty += $item->qty;

        try {
            DB::beginTransaction();
            Item::where('id', $item->id)->update([
                'qty' => $currentQty
            ]);
            Detail_Issuing::where('id', $id)->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->back();
    }
}
