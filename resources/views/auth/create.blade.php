@extends('component.main')

@section('style')
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/choices.js/choices.min.css') }}" />
@endsection

@section('container')
    <div class="page-title">
        <div class="row pb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Form Register</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">master</a></li>
                        <li class="breadcrumb-item active" aria-current="page">item </li>
                        <li class="breadcrumb-item active" aria-current="page">create </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Form Registerasi Akun</h4>
                        <a href="/setting/account/list-account" class=" me-1 mb-1">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="/setting/account/store" method="POST" class="form form-vertical">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="valid-state ">Nama</label>
                                                <div class="form-group d-flex">
                                                    <input type="text" name="name" class="form-control "
                                                        id="valid-state" placeholder="" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state ">Username</label>
                                                <div class="form-group d-flex">
                                                    <input type="text" name="username" class="form-control "
                                                        id="valid-state" placeholder="" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state ">Password</label>
                                                <div class="form-group d-flex">
                                                    <input type="text" name="password" class="form-control "
                                                        id="valid-state" placeholder="" value="" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="valid-state">Role</label>
                                                <div class="form-group">
                                                    <select name="role" class="choices form-select ">
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection


@section('script')
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('assets/vendors/choices.js/choices.min.js') }}"></script>
@endsection
