<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="{{ asset('assets/img-logo/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth" class="pt-5">
        <div class="container mt-0 pt-0">
            <div class="row mt-0 pt-0">
                <div class="col-md-5 col-sm-12 mx-auto mt-0 pt-0">
                    <div class="card pt-4 mt-0 ">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                @if (session('loginError'))
                                <div class="alert alert-danger">
                                    {{ session('loginError') }}
                                </div>
                                @endif

                                <img src="{{ asset('assets/img-logo/logo.png') }}" height="80" class='mb-4'>
                                <h3>Sign In</h3>
                                <p>Please sign in to continue to Dashboard.</p>
                            </div>
                            <form action="/" method="POST">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" name="username" class="form-control" id="username" required>
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-start">
                                        <input type="checkbox" id="checkbox1" class='form-check-input'>
                                        <label for="checkbox1">Remember me</label>
                                    </div>
                                    <div class="float-end">
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-end">Login </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>