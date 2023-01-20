@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Report Receiving</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Receiving </li>
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
                                <a href="/report/receiving" class="btn btn-warning ms-2" style="height: 40px">
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
                List Data Ball
            </div>
            <div class="card-body ">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-2">No</th>
                            <th class="p-2" style="width: 115px;">Date</th>
                            <th class="p-1" style="width:140px;">Ball
                                <br> Number
                            </th>
                            <th class="p-2" style="width:35px;">Supplier</th>
                            <th class="p-2">Category </th>
                            <th class="p-0" style="width: 20px">Target
                                <br> Qty
                            </th>
                            <th class="p-1" style="width: 20px">Open
                                <br> Qty
                            </th>
                            <th class="p-2">Total
                                <br> Price
                            </th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr class="p-0 m-0 ">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="p-2" style="width: 115px;">{{ $data->date }}</td>
                                <td class="p-1" style="width:140px;">{{ $data->ball_number }}</td>
                                <td class="p-2" style="width:35px;">{{ $data->supplier->name }}</td>
                                <td class="p-2">{{ $data->category_product->name }}</td>
                                <td class="p-0">{{ $data->target_qty }}</td>
                                <td class="p-2">{{ $data->open_qty }}</td>
                                <td class="p-2">{{ 'Rp' . $data->price }}</td>
                                <td style="padding: 0px;">
                                    <a href="/report/receiving/{{ $data->id }}/print"
                                        class="btn badge btn-sm round btn-info ">
                                        <i class="fas fa-print"></i>
                                    </a>
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
