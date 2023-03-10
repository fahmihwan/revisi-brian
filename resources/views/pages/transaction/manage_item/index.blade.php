@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kelola Barang Masuk</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">tansaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">barang masuk </li>
                        <li class="breadcrumb-item active" aria-current="page">tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section class="section">
        <div class="card">
            <div class="card-body p-2 ">
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="nav mb-3 ">
                        <li class="nav-item">

                            <a class="nav-link fw-bold me-2 border-bottom border-3 border-primary"
                                href="/transaction/manage-receiving/{{ $receiving->kode_ball }}">
                                List
                                Item</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "
                                href="/transaction/manage-receiving/{{ $receiving->kode_ball }}/create">Tambah
                                Item</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a href="/transaction/receiving/{{ $receiving->kode_ball }}/edit" class="nav-link text-warning">
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
                                    <td class="pe-2">Kode Ball</td>
                                    <td>: {{ $receiving->kode_ball }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: {{ $receiving->tanggal }}</td>
                                </tr>

                                <tr>
                                    <td>Catatan</td>
                                    <td>: {{ $receiving->catatan }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-6">
                            <table>
                                <tr>
                                    <td class="pe-3">Kategori Produk</td>
                                    <td>: <span class="badge bg-info">{{ $receiving->kategori_produk->nama }} </span>
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
        <div class="card">
            <div class="card-header p-3">
                List Data Supplier
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-1">No</th>
                            <th class="p-1">Name</th>
                            <th class="p-1">Kategori Brand</th>
                            <th class="p-1">qty</th>
                            <th class="p-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manage_item as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="p-1"> {{ $item->item->nama }}</td>
                                <td class="p-1"> {{ $item->item->kategori_brand->nama }}</td>
                                <td class="p-1"> {{ $item->qty }}</td>
                                <td>
                                    <form action="/transaction/manage-receiving/{{ $item->id }}" method="post"
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
