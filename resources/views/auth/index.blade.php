@extends('component.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endsection

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List Account</h3>
                <a href="/setting/account/create" class="btn btn-sm round  btn-primary mb-3">tambah data</a>
                <!-- Button trigger for basic modal -->
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Account </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header p-3">
                List Account
            </div>
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Username</th>
                            <th class="p-3">Role</th>
                            <th class="p-3">Create</th>
                            <th class="p-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">{{ $user->nama }}</td>
                                <td class="p-3">{{ $user->username }}</td>
                                <td class="p-3">{{ $user->role }}</td>
                                <td class="p-3">{{ $user->created_at }}</td>
                                <td class="p-0">
                                    <form action="/setting/account/{{ $user->id }}/destroy" method="POST"
                                        class=" d-inline-block">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn badge  btn-sm round btn-danger"
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
