@extends('component.main')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Receiving</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier </li>
                        <li class="breadcrumb-item active" aria-current="page">create </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        @if (session()->has('fail'))
            <div class="alert alert-danger mb-4">
                <i class="fa-solid fa-bell"></i> {!! session('fail') !!}
            </div>
        @endif
        <div class="row match-height">

            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Form Edit Receiving</h4>
                        <a href="/transaction/manage-receiving/{{ $receiving->ball_number }}" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/transaction/receiving/{{ $receiving->ball_number }}" method="POST"
                                class="form form-vertical">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valid-state">Ball Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $receiving->ball_number }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Pilih Supplier</label>
                                                <div class="form-group">
                                                    <select name="supplier_id"
                                                        class="js-example-basic-single-1 form-select">
                                                        <option value="{{ $receiving->supplier->id }}">
                                                            {{ $receiving->supplier->name }}</option>
                                                        @foreach ($supplier as $sup)
                                                            <option value="{{ $sup->id }}">{{ $sup->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Kategori Produk</label>
                                                <div class="form-group">
                                                    <select name="category_product_id"
                                                        class="js-example-basic-single-1 form-select">
                                                        <option value="{{ $receiving->category_product->id }}">
                                                            {{ $receiving->category_product->name }}</option>
                                                        @foreach ($category_product as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Tanggal</label>
                                                <input type="date" name="date" class="form-control"
                                                    value="{{ $receiving->date }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="valid-state">Target Qty</label>
                                                        <input type="number" name="target_qty" class="form-control"
                                                            value="{{ $receiving->target_qty }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="valid-state">Open Qty</label>
                                                        <input type="number" class="form-control"
                                                            value="{{ $receiving->open_qty }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Harga</label>
                                                <input type="number" name="price" class="form-control"
                                                    value="{{ $receiving->price }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Note</label>
                                                <textarea name="note" class="form-control" id="" cols="10" rows="3">{{ $receiving->note }}</textarea>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script> --}}
    <script>
        $('.js-example-basic-single-1').select2()
        $('.js-example-basic-single-2').select2()
    </script>
@endsection
