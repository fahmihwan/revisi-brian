@extends('component.main')

@section('style')
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Item</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">item </li>
                        <li class="breadcrumb-item active" aria-current="page">create </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Item</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/master/item" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label for="valid-state ">Nama Item</label>
                                                <div class="form-group">

                                                    <input type="text" name="name" class="form-control "
                                                        id="valid-state" placeholder="" value="" required>


                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Pilih Kategori Produk</label>
                                                <div class="form-group">
                                                    <select name="category_product_id" class="choices form-select">
                                                        @foreach ($category_product as $product)
                                                            <option value="{{ $product->id }}">{{ $product->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Pilih Kategori Brand</label>
                                                <div class="form-group">
                                                    <select name="category_brand_id" class="choices form-select ">
                                                        @foreach ($category_brand as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>




                                            <div class="form-group">
                                                <label for="valid-state">Qty</label>
                                                <input type="number" name="qty" class="form-control " id="valid-state"
                                                    placeholder="" value="" required>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    This is valid state.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection
