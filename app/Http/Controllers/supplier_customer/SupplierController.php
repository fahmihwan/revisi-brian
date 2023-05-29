<?php

namespace App\Http\Controllers\supplier_customer;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // print
        if (request('print')) {
            $data = Supplier::latest()->whereDate('created_at', '>=', request('start_date'))
                ->whereDate('created_at', '<=', request('end_date'))->get();

            if ($data->count() == 0) {
                return redirect('/supplier-customer/supplier')->withErrors('Data tanggal ' . request('start_date') . ' sampai ' . request('end_date') . ' tidak ada');
            }

            $pdf = Pdf::loadView('pages.supplier_customer.supplier.print_supplier', [
                'datas' => $data
            ]);
            return $pdf->download('supplier.pdf');
        }

        // search
        if (request('start_date')) {
            $supplier = Supplier::latest()->whereDate('created_at', '>=', request('start_date'))
                ->whereDate('created_at', '<=', request('end_date'))->get();
        } else {
            $supplier = Supplier::latest()->get();
        }

        return view('pages.supplier_customer.supplier.index', [
            'data_supplier' => $supplier
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.supplier_customer.supplier.create');
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
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        Supplier::create([
            'nama' => $data['name'],
            'alamat' => $data['address'],
            'telp' => $data['phone_number'],
        ]);
        return redirect('/supplier-customer/supplier');
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
        $data = Supplier::where(['id' => $id])->first();

        return view('pages.supplier_customer.supplier.edit', [
            'supplier' => $data
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
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        Supplier::where('id', $id)->update([
            'nama' => $data['name'],
            'alamat' => $data['address'],
            'telp' => $data['phone_number'],
        ]);


        return redirect('/supplier-customer/supplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->delete();
        return redirect('/supplier-customer/supplier');
    }
}
