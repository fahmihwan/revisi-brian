@extends('component.main')

@section('style')
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Issuing / In</h3>
                {{-- <a href="/transaction/issuing/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a> --}}
                {{-- <h4 class="card-title">Form </h4> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Brand </li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card py-3   ">
                    <div class=" d-flex justify-content-between px-4 ">
                        <div>
                            <a href="" class="me-3">
                                print
                                <i class="fa-solid fa-print"></i>
                            </a>
                        </div>
                        <a href="/transaction/issuing" class=" me-1 mb-1 ms-5">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header  d-flex justify-content-between">
                        <div class="text-danger">
                            Detail Tansaksi
                        </div>
                        <a href="/transaction/issuing/{{ $id }}/edit" class="ms-3 text-warning ">
                            edit <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>No Referensi</td>
                                <td class="p-2"> : {{ $detail_issuings->no_referensi }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td class="p-2"> : {{ $detail_issuings->tanggal }}</td>
                            </tr>
                            <tr>
                                <td>Customer</td>
                                <td class="p-2"> : {{ $detail_issuings->customer->nama }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td class="p-2"> : {{ $detail_issuings->customer->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-3 d-flex justify-content-between">
                        List Data Supplier
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th class="p-3">No</th>
                                    <th class="p-3">Item</th>
                                    <th class="p-3">Brand</th>
                                    <th class="p-3">Category</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-0">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_issuings->detail_barang_keluars as $item)
                                    <tr>
                                        <td class="p-3">{{ $loop->iteration }}</td>
                                        <td class="p-3">{{ $item->item->nama }}</td>
                                        <td class="p-3">{{ $item->item->kategori_brand->nama }}</td>
                                        <td class="p-3">{{ $item->item->kategori_produk->nama }}</td>
                                        <td class="p-3">{{ $item->qty }}</td>
                                        <td>
                                            <form action="/transaction/issuing/{{ $item->id }}" method="post"
                                                class=" d-inline-block">
                                                @method('delete')
                                                @csrf
                                                <button class="btn badge  btn-sm round btn-danger"
                                                    onClick="return confirm('Are you sure?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


@section('script')
@endsection
