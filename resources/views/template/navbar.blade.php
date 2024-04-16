<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                @php
                    // Ambil data ikon dari setting pertama yang ditemukan
                    $setting = \App\Models\Setting::first();
                    $icon = $setting ? asset($setting->icon) : ''; // Periksa apakah setting ditemukan sebelum mengakses ikon
                @endphp
                <div class="logo">

                    {{-- <a href="index.html"><img src="" alt="Logo" srcset=""></a> --}}
                    <h5 class="primary"> <img src="{{ $icon }}"
                            style="height: 60px; width: auto; margin-right: 10px;"> {{ env('APP_NAME') }}</h5>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-list-ul"></i>
                        <span>Kategori</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/kategori">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="/subkategori">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                                <span>Sub Kategori</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="/produk" class='sidebar-link'>
                        <i class="bi bi-ui-checks"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/riwayatorder" class='sidebar-link'>
                        <i class="bi bi-clock-history"></i>
                        <span>History Orders</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-cash-stack"></i>
                        <span>Manage Deposit</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/daftarsaldo">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                                <span>List Deposit</span>
                            </a>
                        </li>
                        <li class="submenu-item">
                            <a href="/riwayatdeposit">
                                <i class="bi bi-arrow-right-circle-fill"></i>
                                <span>Riwayat Deposit</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="/users" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/setting" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Setting Website</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="/logout" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
