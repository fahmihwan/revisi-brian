@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Kategori Produk</h3>
                {{-- <a href="/master/kategori-prouduk/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a> --}}

                <!-- Button trigger for basic modal -->
                <button type="button" class="btn btn-sm round  btn-primary mb-3" data-bs-toggle="modal"
                    data-bs-target="#default">
                    Tambah Data
                </button>
                <!--Basic Modal -->
                <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">

                        {{-- form --}}
                        <form class="form form-vertical" method="post" action="/master/kategori-produk">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header p-2">
                                    <h5 class="modal-title" id="myModalLabel1">Input Kategori </h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="valid-state">Kategori</label>
                                                    <input type="text" name="name"
                                                        class="form-control  @error('name') is-invalid @enderror"
                                                        id="valid-state" placeholder="Kategori Produk"
                                                        value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <div class="valid-feedback">
                                                            <i class="bx bx-radio-circle"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer p-2">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Accept</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List kategori produk </li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header p-3">
                Kategori Produk
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $data)
                            <tr class="p-0 m-0 ">
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $data->name }}</td>
                                <td style="padding: 0px;">
                                    <a href="/master/kategori-produk/{{ $data->id }}/edit"
                                        class="btn badge btn-sm round btn-warning ">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="/master/kategori-produk/{{ $data->id }}" method="post"
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
