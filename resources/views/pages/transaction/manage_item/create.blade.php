@extends('component.main')

@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Receiving Transcation </h3>
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
        @if (session()->has('success'))
            <div class="alert alert-success mb-4">
                <i class="fa-solid fa-bell"></i> {!! session('success') !!}
            </div>
        @endif

        <div class="card">
            <div class="card-body p-2 ">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="nav mb-3 ">
                        <li class="nav-item">
                            <a class="nav-link me-2" href="/transaction/manage-receiving/{{ $receiving->ball_number }}">List
                                Item</a>
                        </li>
                        <li class="nav-item fw-bold border-bottom border-3 border-primary">
                            <a class="nav-link"
                                href="/transaction/manage-receiving/{{ $receiving->ball_number }}/create">Tambah
                                Item</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="/transaction/receiving/{{ $receiving->ball_number }}/edit" class="nav-link text-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="/transaction/receiving" class="nav-link"> <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                </div>

                <div class="m-2">
                    <div class="row ">
                        <div class="col-6">
                            <table>
                                <tr>
                                    <td class="pe-2">Ball Number</td>
                                    <td>: {{ $receiving->ball_number }}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>: {{ $receiving->date }}</td>
                                </tr>

                                <tr>
                                    <td>Note</td>
                                    <td>: {{ $receiving->note }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-6">
                            <table>
                                <tr>
                                    <td class="pe-3">Category Product</td>
                                    <td>: <span class="badge bg-info">{{ $receiving->category_product->name }} </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Target Qty</td>
                                    <td>: <span class="badge bg-info">{{ $receiving->target_qty }}</span></td>
                                </tr>
                                <tr>
                                    <td>Open Qty</td>
                                    <td>: <span class="badge bg-warning">{{ $receiving->open_qty }} </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">

        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-8 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Item</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="/transaction/manage-receiving" method="post" class="form form-vertical">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="valid-state">Nama Item</label>
                                                    <div class="form-group">
                                                        <select name="name"
                                                            class="choices form-select js-example-basic-single-1">
                                                            @foreach ($item_name as $detail)
                                                                <option value="{{ $detail->id }}">
                                                                    {{ $detail->name }} &nbsp; &nbsp;
                                                                    [
                                                                    {{ $detail->category_brand->name }} ]
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <input type="hidden" name="ball_number"
                                                    value="{{ $receiving->ball_number }}">
                                                <input type="hidden" name="category_product_id"
                                                    value="{{ $receiving->category_product->id }}">
                                                {{-- 
                                                <div class="form-group">
                                                    <label for="valid-state">Kategori Brand</label>
                                                    <select name="category_brand_id" class="choices form-select">
                                                        @foreach ($category_brand as $brand)
                                                            <option value="{{ $brand->id }}">
                                                                {{ $brand->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Open Qty</label>
                                                    <input type="number" id="contact-info-vertical" class="form-control"
                                                        name="open_qty" placeholder="Qty" min="1" required
                                                        style="width:200px;">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
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

    </section>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script> --}}
    <script>
        $('.js-example-basic-single-1').select2()
    </script>
@endsection
