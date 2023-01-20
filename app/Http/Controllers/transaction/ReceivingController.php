<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use App\Models\Category_product;
use App\Models\Receiving;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Receiving::with(['supplier:id,name', 'category_product:id,name'])
            ->latest()->get();

        return view('pages.transaction.receiving.index', [
            'receiving_data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppiler = Supplier::all();
        $category_product = Category_product::all();

        return view('pages.transaction.receiving.create', [
            'supplier' => $suppiler,
            'category_product' => $category_product,
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
        $data = $request->validate([
            'date' => 'required',
            'supplier_id' => 'required|numeric',
            'category_product_id' => 'required|numeric',
            'target_qty' => 'required|numeric',
            'price' => 'required|numeric',
            'note' => 'required'
        ]);

        $data['open_qty'] = $request->target_qty;
        $check = Receiving::select('ball_number', 'date')->where('date', $request->date);

        Receiving::create([
            'ball_number' => $this->create_ball_number($request, $check),
            'supplier_id' => $request->supplier_id,
            'category_product_id' => $request->category_product_id,
            'target_qty' => $request->target_qty,
            'open_qty' => 0,
            'date' => $request->date,
            'note' => $request->note,
            'price' => $request->price,
        ]);

        return redirect('/transaction/receiving');
    }

    public function create_ball_number($request, $check)
    {
        if ($check->exists()) { //jika ada
            $getBall = $check->orderBy('ball_number', 'desc')->limit(1)->first();
            $explode_number = explode('-', $getBall->ball_number);
            $increment = (int)$explode_number[1] + 1;
            $data_ball_number = $explode_number[0] . '-' . $increment;
            return $data_ball_number;
        } else { //jika tidak ada
            $firstData = 'BALL' . str_replace('-', '', $request->date) . '-1';
            return $firstData;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $receiving = Receiving::with(['supplier'])
            ->where('ball_number', $id)->first();


        $supplier = Supplier::latest()->get();
        $category_product = Category_product::latest()->get();
        return view('pages.transaction.receiving.edit', [
            'receiving' => $receiving,
            'supplier' => $supplier,
            'category_product' => $category_product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ball_number)
    {
        $validate = $request->validate([
            'supplier_id' => 'required|numeric',
            'category_product_id' => 'required|numeric',
            'target_qty' => 'required|numeric',
            'price' => 'required|numeric',
            'date' => 'required',
            'note' => 'required'
        ]);

        $receiving = Receiving::where('ball_number', $ball_number)->first();

        if ($receiving->open_qty > $request->target_qty) {
            return redirect()->back()->with('fail', 'Jika TARGET QTY < OPEN QTY, hapus data Receiving secara manual!!. <a href="" class="text-decoration-underline">hapus sekarang!</a> ');
        }

        Receiving::where('ball_number', $ball_number)->update($validate);
        return redirect('/transaction/manage-receiving/' . $ball_number);
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
