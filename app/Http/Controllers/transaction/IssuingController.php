<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use App\Models\Category_product;
use App\Models\Customer;
use App\Models\Detail_Issuing;
use App\Models\Issuing;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssuingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Issuing::with(['customer:id,nama,alamat', 'detail_barang_keluars'])
            ->withSum('detail_barang_keluars', 'qty')
            ->latest()->get();

        return view('pages.transaction.issuing.index', [
            'issuing_data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::with(['kategori_brand', 'kategori_produk'])->get();;
        // return $items;
        $category_product = Category_product::all();

        $detail_issuing = Detail_Issuing::with([
            'item:id,nama,kategori_produk_id,kategori_brand_id,qty',
            'item.kategori_brand:id,nama',
            'item.kategori_produk:id,nama'
        ])
            ->where('barang_keluar_id', 0)
            ->get();

        return view('pages.transaction.issuing.create', [
            'items' => $items,
            'category_product' => $category_product,
            'detail_issuings' => $detail_issuing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail_issuing = Detail_Issuing::where('barang_keluar_id', 0);

        if ($detail_issuing->exists() == null) {
            return redirect()->back();
        }
        $validated = $request->validate([
            'date' => 'required',
            'customer' => 'required',
            'address' => 'required',
            'note' => 'required',
        ]);

        $get_last_issuing = Issuing::orderBy('id', 'desc');
        if ($get_last_issuing->exists()) {
            $no_referensi = $this->create_no_referens($get_last_issuing->first()->no_referensi);
        } else {
            $no_referensi = $this->create_no_referens(null);
        }

        try {
            DB::beginTransaction();

            $customer_id = Customer::create([
                'nama' => $validated['customer'],
                'alamat' => $validated['address'],
            ])->id;

            $issuing_id = Issuing::create([
                'no_referensi' => $no_referensi,
                'tanggal' => $validated['date'],
                'customer_id' => $customer_id,
                'catatan' => $validated['note']
            ])->id;


            Detail_Issuing::where('barang_keluar_id', 0)->update([
                'barang_keluar_id' => $issuing_id,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            // DB::rollBack();
            dd($th->getMessage());
        }

        return redirect('transaction/issuing');
    }

    public function create_no_referens($select_kode_ref)
    {
        if ($select_kode_ref == null) {
            $nota = "OUT" . date('Ymd') . "001";
        } else if (substr($select_kode_ref, 9, 2) != date('d')) {
            $nota = "OUT" . date('Ymd') . "001";
        } else {
            $cut = (int)substr($select_kode_ref, 11, 3);
            $number = str_pad($cut + 1, 3, "0", STR_PAD_LEFT);;
            $nota = "OUT" . date('Ymd') . $number;
        }
        return $nota;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Issuing::with([
            'customer',
            'detail_barang_keluars.item.kategori_brand',
            'detail_barang_keluars.item.kategori_produk'
        ])->where('id', $id)->first();

        return view('pages.transaction.issuing.detail', [
            'detail_issuings' => $data,
            'id' => $id
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
        $issuing = Issuing::with('customer')->where('id', $id)->first();
        return view('pages.transaction.issuing.edit', [
            'data' => $issuing,
        ]);
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
        $validated = $request->validate([
            'customer_id' => 'required',
            'date' => 'required',
            'name' => 'required',
            'address' => 'required',
            'note' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Customer::where('id', $validated['customer_id'])->update([
                'nama' => $validated['name'],
                'alamat' => $validated['address'],
            ]);

            Issuing::where('id', $id)->update([
                'tanggal' => $validated['date'],
                'catatan' => $validated['note'],
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

        return redirect('/transaction/issuing/' . $id);
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
        $item = Item::where('id', $detail_issuing->item_id)->first();
        $update_item = $item->qty += $detail_issuing->qty;

        try {
            DB::beginTransaction();

            Item::where('id', $detail_issuing->item_id)->update([
                'qty' => $update_item
            ]);

            Detail_Issuing::where('id', $id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function get_item_ajax($id)
    {
        $getItem = Item::with('kategori_brand')->where('kategori_brand_id', $id)->get();
        return response()->json([
            'status' => 200,
            'data' => $getItem
        ]);
    }

    function get_value_item_ajax($id)
    {

        $getItem = Item::where('id', $id)->get();
        if ($getItem) {
            return response()->json([
                'status' => 200,
                'data' => $getItem
            ]);
        } else {
            return response()->json([
                'status' => 404
            ]);
        }
    }
}
