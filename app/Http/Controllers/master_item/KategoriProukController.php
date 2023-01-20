<?php

namespace App\Http\Controllers\master_item;

use App\Http\Controllers\Controller;
use App\Models\Category_product;
use Illuminate\Http\Request;

class KategoriProukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $katgori = Category_product::all();

        return view(
            'pages.master_item.kategori_produk.index',
            [
                'kategori' => $katgori
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required',
        ]);

        Category_product::create([
            'nama' => $validated['name']
        ]);
        return redirect('/master/kategori-produk');
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
        $data = Category_product::where(['id' => $id])->first();

        return view('pages.master_item.kategori_produk.edit', [
            'data' => $data,
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
        $validated =  $request->validate([
            'name' => 'required',
        ]);


        Category_product::where('id', $id)->update([
            'nama' => $validated['name']
        ]);
        return redirect('/master/kategori-produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category_product::where('id', $id)->delete();
        return redirect('/master/kategori-produk');
    }
}
