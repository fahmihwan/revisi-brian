@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola barang masuk</h3>
                <a href="/transaction/receiving/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">kelola barang masuk </li>
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
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Kode Ball</th>
                            <th class="p-3">Supplier</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3">Target Qty</th>
                            <th class="p-3">Open Qty</th>
                            <th class="p-3">Total Harga</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($receiving_data as $data)
                            @php
                                $total += $data->harga;
                            @endphp
                            <tr class="p-0 m-0  ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $data->tanggal }}</td>
                                <td class="p-3">{{ $data->kode_ball }}</td>
                                <td class="p-3">{{ $data->supplier->nama }}</td>
                                <td class="p-3">{{ $data->kategori_produk->nama }}</td>
                                <td class="p-3">{{ $data->target_qty }}</td>
                                <td class="p-3">
                                    <span
                                        class="badge @if ($data->open_qty != $data->target_qty) bg-warning @else bg-success @endif">
                                        {{ $data->open_qty }}
                                    </span>
                                </td>
                                <td class="p-3">{{ 'Rp' . $data->harga }}</td>
                                <td style="padding: 0px;">
                                    <a href="/transaction/manage-receiving/{{ $data->kode_ball }}"
                                        class="btn badge btn-sm round btn-info ">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    <p>total : Rp{{ $total }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
@endsection
