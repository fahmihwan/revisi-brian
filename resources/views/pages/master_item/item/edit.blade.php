@extends('component.main')

@section('style')
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Item</h3>
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
                        <h4 class="card-title">Update </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/master/item/{{ $data_edit->id }}" method="POST" class="form form-vertical">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group ">
                                                <label for="valid-state ">Detail item </label>
                                                <div class="form-group d-flex">
                                                    <div style="width: 80%">
                                                        {{-- <select name="detail_brand_id" class="choices form-select">
                                                            <option value="{{ $data_edit->detail_brand->id }}">
                                                                {{ $data_edit->detail_brand->name }}</option>
                                                            @foreach ($detail_brand as $detail)
                                                                <option value="{{ $detail->id }}">{{ $detail->name }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}
                                                        <input type="text" name="name" class="form-control "
                                                            id="valid-state" placeholder="" value="{{ $data_edit->name }}"
                                                            required>

                                                    </div>
                                                    <div style="width: 18%">
                                                        <!-- Button trigger for basic modal -->
                                                        <button type="button"
                                                            class="btn rounded-none rounded-end  btn-warning block"
                                                            data-bs-toggle="modal" data-bs-target="#default"
                                                            style="width: 100%; height: 100%;">
                                                            <i class="fa-solid fa-plus"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Pilih Catgory Product</label>
                                                <div class="form-group">
                                                    <select name="category_product_id" class="choices form-select">
                                                        <option selected value="{{ $data_edit->category_product->id }}">
                                                            {{ $data_edit->category_product->name }} </option>
                                                        @foreach ($category_product as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Pilih Category Brand</label>
                                                <div class="form-group">
                                                    <select name="category_brand_id" class="choices form-select ">
                                                        <option value="{{ $data_edit->category_brand->id }}" selected>
                                                            {{ $data_edit->category_brand->name }}</option>
                                                        @foreach ($category_brand as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="valid-state">Qty</label>
                                                <input type="number" name="qty" class="form-control " id="valid-state"
                                                    placeholder="" value="{{ $data_edit->qty }}" required>
                                                <div class="valid-feedback">
                                                    <i class="bx bx-radio-circle"></i>
                                                    This is valid state.
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Updte</button>
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
    <!--Basic Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form action="/master/item/store_detail_brand" method="post" class="form form-vertical">
                @csrf
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title" id="myModalLabel1">Input
                            Detail Brand</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="valid-state">Detail
                                            Brand</label>
                                        <input type="text" class="form-control @error('record') is-invalid @enderror"
                                            id="valid-state" placeholder="Detail Brand" value="{{ old('name') }}"
                                            required name="name">
                                        @error('name')
                                            <div class="valid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end Modal --}}
@endsection


@section('script')
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection
