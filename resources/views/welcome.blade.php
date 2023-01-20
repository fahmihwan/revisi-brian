<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/setting/account/store" method="POST" class="form form-vertical">
        @csrf
        <div class="form-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="valid-state ">Nama</label>
                        <div class="form-group d-flex">
                            <input type="text" name="name" class="form-control " id="valid-state" placeholder=""
                                value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valid-state ">Username</label>
                        <div class="form-group d-flex">
                            <input type="text" name="username" class="form-control " id="valid-state" placeholder=""
                                value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="valid-state ">Password</label>
                        <div class="form-group d-flex">
                            <input type="text" name="password" class="form-control " id="valid-state" placeholder=""
                                value="" required>
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
</body>

</html>
