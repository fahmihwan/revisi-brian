<div id="sidebar" class='active'>
    <div class="sidebar-wrapper  active mb-0 ">
        <div class="sidebar-header text-center p-3">
            <img src="{{ asset('assets/img-logo/logo.png') }}" alt="" srcset=""
                style="width:50px; height:50px;"> <span class="text-dark">Inventroy</span>
        </div>
        <div class="sidebar-menu mt-0 pt-0">
            <ul class="menu   mt-0 pt-0">
                <li class='sidebar-title py-0 my-0'>Core</li>
                <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }} ">
                    <a href="/dashboard" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->role == 'user')
                    <li class='sidebar-title '>Supplier - Customer</li>
                    <li class="sidebar-item  has-sub {{ request()->is('supplier-customer/*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link '>
                            <i data-feather="briefcase" width="20"></i>
                            <span>Suppiler - Customer</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="/supplier-customer/supplier">Supplier</a>
                            </li>
                            <li>
                                <a href="/supplier-customer/customer">Customer</a>
                            </li>
                        </ul>
                    </li>
                    <li class='sidebar-title'>master</li>
                    <li class="sidebar-item  has-sub {{ request()->is('master/*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link '>
                            <i data-feather="briefcase" width="20"></i>
                            <span>Master Item</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="/master/kategori-produk">Kategori Produk</a>
                            </li>
                            <li>
                                <a href="/master/kategori-brand">Kategori Brand</a>
                            </li>
                            <li>
                                <a href="/master/item">Item</a>
                            </li>
                        </ul>
                    </li>

                    <li class='sidebar-title'>Transaction</li>
                    <li class="sidebar-item {{ request()->is('*receiving*') ? 'active' : '' }}  ">
                        <a href="/transaction/receiving" class='sidebar-link'>
                            <i data-feather="layout" width="20"></i>
                            <span>Receiving / In</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->is('*issuing*') ? 'active' : '' }} ">
                        <a href="/transaction/issuing" class='sidebar-link'>
                            <i data-feather="layers" width="20"></i>
                            <span>Issuing / Out</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role == 'admin')
                    <li class='sidebar-title'>Report</li>
                    <li class="sidebar-item has-sub {{ request()->is('*report*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i data-feather="briefcase" width="20"></i>
                            <span>Report</span>
                        </a>
                        <ul class="submenu ">
                            <li>
                                <a href="/report/stock">Stock</a>
                            </li>
                            <li>
                                <a href="/report/issuing">Issuing</a>
                            </li>
                            <li>
                                <a href="/report/receiving">Receiving</a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
