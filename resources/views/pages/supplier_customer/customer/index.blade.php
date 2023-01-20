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
                            <th class="p-3">Name</th>
                            <th class="p-3">Address</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_customer as $customer)
                            <tr class="p-0 m-0 ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $customer->name }}</td>
                                <td class="p-3">{{ $customer->address }}</td>
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
