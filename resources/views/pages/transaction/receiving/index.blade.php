@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Receiving / In</h3>
                <a href="/transaction/receiving/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Brand </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header p-3">
                List Data Ball
            </div>
            <div class="card-body ">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Ball Number</th>
                            <th class="p-3">Supplier</th>
                            <th class="p-3">Category </th>
                            <th class="p-3">Target Qty</th>
                            <th class="p-3">Open Qty</th>
                            <th class="p-3">Total Price</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receiving_data as $data)
                            {{-- <tr class="p-0 m-0 @if ($data->open_qty != $data->target_qty) table-danger @endif "> --}}
                            <tr class="p-0 m-0  ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $data->date }}</td>
                                <td class="p-3">{{ $data->ball_number }}</td>
                                <td class="p-3">{{ $data->supplier->name }}</td>
                                <td class="p-3">{{ $data->category_product->name }}</td>
                                <td class="p-3">{{ $data->target_qty }}</td>
                                <td class="p-3">
                                    <span
                                        class="badge @if ($data->open_qty != $data->target_qty) bg-warning @else bg-success @endif">
                                        {{ $data->open_qty }}
                                    </span>
                                </td>
                                <td class="p-3">{{ 'Rp' . $data->price }}</td>
                                <td style="padding: 0px;">
                                    <a href="/transaction/manage-receiving/{{ $data->ball_number }}"
                                        class="btn badge btn-sm round btn-info ">
                                        <i class="fa-regular fa-folder-open"></i>
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
