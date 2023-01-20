@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Barang Keluar</h3>
                <a href="/transaction/issuing/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Barang Keluar </li>
                    </ol>
                </nav>
            </div>
        </div>

    </div>
    <section class="section">
        <div class="card">
            <div class="card-header p-3">
                List Barang Keluar
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">No Referensi</th>
                            <th class="p-3">Customer</th>
                            <th class="p-3" style="width: 240px">Alamat</th>
                            <th class="p-3">Qty</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($issuing_data as $data)
                            <tr class="p-0 m-0 ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $data->tanggal }}</td>
                                <td class="p-3">{{ $data->no_referensi }}</td>
                                <td class="p-3">{{ $data->customer->nama }}</td>
                                <td class="p-3" style="width: 240px">{{ $data->customer->alamat }}</td>
                                <td class="p-3">{{ $data->detail_barang_keluars_sum_qty }}</td>
                                <td style="padding: 0px;">
                                    <a href="/transaction/issuing/{{ $data->id }}"
                                        class="btn badge btn-sm round btn-info ">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </a>
                                    {{-- <form action="" method="post" class=" d-inline-block">
                                        @method('delete')
                                        @csrf
                                        <button class="btn badge  btn-sm round btn-danger"
                                            onClick="return confirm('Are you sure?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form> --}}
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
