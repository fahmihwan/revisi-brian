<nav class="navbar navbar-header navbar-expand navbar-light">
    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
    <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
            <li class="dropdown nav-icon">

            </li>

            <li class="dropdown">
                <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <div class="avatar me-1">
                        <span class="bg-light rounded-pill align-items-center d-flex justify-content-center"
                            style="width: 34px; height: 34px;">
                            <i class="fa-regular fa-user"></i>
                        </span>
                    </div>
                    <div class="d-none d-md-block d-lg-inline-block">{{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    @if (Auth::user()->role == 'admin')
                        <a class="dropdown-item" href="/setting/account/list-account"><i data-feather="user"></i>
                            Account</a>
                        <div class="dropdown-divider"></div>
                    @endif
                    <form action="/authenticate/logout" method="post" class=" ">
                        @csrf
                        <button class="dropdown-item" type="submit">
                            <i data-feather="log-out"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
