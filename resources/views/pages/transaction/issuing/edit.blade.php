@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Transaksi</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">kategori produk </li>
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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Form Edit Transaksi</h4>
                        <a href="/transaction/issuing/{{ $data->id }}" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form action="/transaction/issuing/{{ $data->id }}" method="POST"
                                class="form form-vertical">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">No Referensi</label>
                                                <input type="text" value="{{ $data->no_referensi }}" name="date"
                                                    disabled class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Tanggal</label>
                                                <input type="date" value="{{ $data->tanggal }}" name="date"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" value="{{ $data->customer->id }}" name="customer_id"
                                                    class="form-control">
                                                <label for="name">Nama</label>
                                                <input type="text" value="{{ $data->customer->nama }}" name="name"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Alamat</label>
                                                <input type="text" value="{{ $data->customer->alamat }}" name="address"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Catatan</label>
                                                <textarea name="note" class="form-control" id="" cols="30" rows="5">{{ $data->catatan }}</textarea>
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
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
@endsection
