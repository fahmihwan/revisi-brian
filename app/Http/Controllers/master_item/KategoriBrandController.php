<?php

namespace App\Http\Controllers\master_item;

use App\Http\Controllers\Controller;
use App\Models\Category_brand;
use Illuminate\Http\Request;

class KategoriBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori_brand = Category_brand::latest()->get();
        return view('pages.master_item.kategori_brand.index', [
            'kategori_brand' => $kategori_brand
        ]);
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
        $data = $request->validate([
            'name' => 'required',
        ]);

        Category_brand::create([
            'nama' => $data['name']
        ]);

        return redirect('/master/kategori-brand');
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
        $data = Category_brand::where(['id' => $id])->first();


        return view('pages.master_item.kategori_brand.edit', [
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
        $data = $request->validate([
            'name' => 'required',
        ]);
        Category_brand::where('id', $id)->update([
            'nama' => $data['name']
        ]);
        return redirect('/master/kategori-brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category_brand::where('id', $id)->delete();
        return redirect('/master/kategori-brand');
    }
}
