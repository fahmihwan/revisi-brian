@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Supplier</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Supplier - Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Supplier </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <h4 class="card-title">Form Edit Supplier</h4>
                        <a href="/supplier-customer/supplier" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form action="/supplier-customer/supplier/{{ $supplier->id }}" method="POST"
                                class="form form-vertical">
                                @method('PUT')
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror " id="name"
                                                    placeholder="nama" value="{{ $supplier->nama }}" required>
                                                @error('name')
                                                    <div class="valid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" name="address"
                                                    class="form-control @error('address')
                                                    is-invalid
                                                @enderror"
                                                    id="alamat" placeholder="alamat" value="{{ $supplier->alamat }}"
                                                    required>
                                                @error('address')
                                                    <div class="valid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">Telp</label>
                                                <input type="text" name="phone_number"
                                                    class="form-control
                                                 @error('phone_number')
                                                    is-invalid
                                                @enderror "
                                                    id="telp" placeholder="nomor hp" value="{{ $supplier->telp }}"
                                                    required>
                                                @error('phone_number')
                                                    <div class="valid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
