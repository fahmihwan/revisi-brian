@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah barang Keluar </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Supplier </li>
                        <li class="breadcrumb-item active" aria-current="page">create </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    @if (session()->has('fail'))
        <div class="alert alert-danger mb-4">
            <i class="fa-solid fa-bell"></i> {!! session('fail') !!}
        </div>
    @endif

    <section class="section">
        <div class="row match-height">
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header pb-0 mb-0">
                        <h4 class="card-title">Form barang keluar</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/transaction/detail_issuing" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">

                                                <label for="valid-state">Pilih Item</label>
                                                <select name="item_id" class="choices form-select"
                                                    id="js-example-basic-single-2">
                                                    <option value="0">cari item ...</option>
                                                    @foreach ($items as $item)
                                                        <option value="{{ $item->id }}">
                                                            [ {{ $item->kategori_produk->nama }} ] -- {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex align-items-center justify-content-between">
                                            <div class="">
                                                Jml Item : <span id="jml-item">0</span>
                                            </div>
                                            <div class="d-flex">
                                                <input type="number" name="qty" class="form-control me-3"
                                                    style="width: 60px" min="1" max="10" value="0"
                                                    autocomplete="off">
                                                <button id="btn-plus" type="submit" class="btn btn-primary me-1 mb-1">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header pb-0 mb-0  d-flex justify-content-between">
                        <h4 class="card-title">Form </h4>
                        <a href="/transaction/issuing" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/transaction/issuing" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label for="valid-state">Tanggal</label>
                                                <div class="form-group ">
                                                    <input type="date" name="date" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="valid-state">Customer</label>
                                                <div class="form-group ">
                                                    <input type="text" name="customer" value="{{ old('customer_id') }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="valid-state">Alamat</label>
                                                <div class="form-group ">
                                                    <input type="text" name="address" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label for="valid-state">Catatan</label>
                                                <div class="form-group ">
                                                    <textarea name="note" id="" cols="" rows="3" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group float-end">
                                                <button class="btn btn-sm btn-warning ">Cancel</button>
                                                <button class="btn btn-sm btn-primary">Submit</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-content px-3">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th class="p-3">No</th>
                                    <th class="p-3">Item</th>
                                    <th class="p-3">Brand</th>
                                    <th class="p-3">Kategori</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_issuings as $detail)
                                    <tr>
                                        <td class="p-3">{{ $loop->iteration }}</td>
                                        <td class="p-3">{{ $detail->item->nama }} </td>
                                        <td class="p-3">{{ $detail->item->kategori_brand->nama }}</td>
                                        <td class="p-3">{{ $detail->item->kategori_produk->nama }}</td>
                                        <td class="p-3">{{ $detail->qty }}</td>
                                        <td style="padding: 0px;">
                                            <form action="/transaction/detail_issuing/{{ $detail->id }}" method="post"
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
            </div>

        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script> --}}

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/j    s/select2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#js-example-basic-single-2').change(function(e) {
                $.ajax({
                    type: 'GET',
                    url: `/transaction/issuing/${$(this).val()}/get-valut-item-ajax`,
                    success: function(data) {
                        if (data.status == 200) {
                            console.log(data.data);
                            data.data.forEach(e => {
                                $('#jml-item').html(e.qty)
                            })
                            $('#btn-plus').attr('disabled', false);
                        }
                    }
                })
            })
        })
    </script>
@endsection
