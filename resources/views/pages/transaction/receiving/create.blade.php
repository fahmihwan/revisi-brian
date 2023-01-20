@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Insert Receiving Transcation </h3>
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
        <div class="row match-height">
            <div class="col-md-9 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Form Receiving Ball</h4>
                        <a href="/transaction/issuing" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/transaction/receiving" method="post" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valid-state">Tanggal</label>
                                                <input type="date" class="form-control " id="valid-state"
                                                    placeholder="Valid" name="date" value="" required>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    This is valid state.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Supplier</label>
                                                <select name="supplier_id" class="choices form-select">
                                                    @foreach ($supplier as $sup)
                                                        <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Kategori Produk</label>
                                                <select name="category_product_id" class="choices form-select">
                                                    @foreach ($category_product as $prodcut)
                                                        <option value="{{ $prodcut->id }}">{{ $prodcut->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="valid-state">Qty</label>
                                                <input type="number" name="target_qty" class="form-control "
                                                    id="valid-state" placeholder="jumlah isi ball" value="" required>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    This is valid state.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Harga</label>
                                                <input type="number" name="price" class="form-control " id="valid-state"
                                                    placeholder="Harga Ball" value="" required>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    This is valid state.
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Catatan</label>
                                                <textarea name="note" class="form-control " id="" cols="10" rows="3"></textarea>
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
