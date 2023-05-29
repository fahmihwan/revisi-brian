@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Customer</h3>
                <a href="/supplier-customer/customer/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Supplier - Customer</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Customer </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger  m-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <form action="" method="GET" class="d-flex">
                            <div class="form-group me-3">
                                <label for="">start date</label>
                                <input type="date" name="start_date" required class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="">end date</label>
                                <input type="date" name="end_date" required class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="d-flex align-items-center ms-3 mt-2">
                                <button type="submit" class="btn btn-primary" style="height: 40px">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                                <button name="print" value="ok" class="btn btn-info ms-2" style="height: 40px">
                                    <i class="fa-solid fa-print"></i>
                                </button>
                                <a href="" class="btn btn-warning ms-2" style="height: 40px">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="card">
            <div class="card-header p-3">
                List Customer
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_customer as $customer)
                            <tr class="p-0 m-0 ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $customer->nama }}</td>
                                <td class="p-3">{{ $customer->alamat }}</td>
                                <td style="padding: 0px;">
                                    <a href="/supplier-customer/customer/{{ $customer->id }}/edit"
                                        class="btn badge btn-sm round btn-warning ">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="/supplier-customer/customer/{{ $customer->id }}" method="post"
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

    </section>
@endsection


@section('script')
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
@endsection
