<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-dark position-sticky top-0 shadow py-2"
    style="background-color: #5957f9;">
    <div class="container">
        @php
            // Ambil data ikon dari setting pertama yang ditemukan
            $setting = \App\Models\Setting::first();
            $icon = $setting ? asset($setting->icon) : ''; // Periksa apakah setting ditemukan sebelum mengakses ikon
        @endphp
        <a class="navbar-brand mr-lg-5 d-flex align-items-center" href="/">
            <img src="{{ $icon }}" style="height: 60px; width: auto; margin-right: 10px;">
        </a>



        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
            aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand mr-lg-5 d-flex align-items-center" href="/">
                            <img src="{{ $icon }}" style="height: 60px; width: auto; margin-right: 10px;">
                            {{-- <span style="font-size: 10px; color:#5957f9; font-weight:900;"> Encorejeune </span> --}}
                        </a>

                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            {{-- <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="ni ni-ui-04 d-lg-none"></i>
                        <span class="nav-link-inner--text">Components</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl">
                        <div class="dropdown-menu-inner">
                            <a href="https://demos.creative-tim.com/argon-design-system/docs/getting-started/overview.html"
                                class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
                                    <i class="ni ni-spaceship"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="heading text-primary mb-md-1">Getting started</h6>
                                    <p class="description d-none d-md-inline-block mb-0">Learn how to use compiling
                                        Scss, change brand colors and more.</p>
                                </div>
                            </a>
                            <a href="https://demos.creative-tim.com/argon-design-system/docs/foundation/colors.html"
                                class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                    <i class="ni ni-palette"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h6 class="heading text-primary mb-md-1">Foundation</h6>
                                    <p class="description d-none d-md-inline-block mb-0">Learn more about colors,
                                        typography, icons and the grid system we used for .</p>
                                </div>
                            </a>
                            <a href="https://demos.creative-tim.com/argon-design-system/docs/components/alerts.html"
                                class="media d-flex align-items-center">
                                <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                    <i class="ni ni-ui-04"></i>
                                </div>
                                <div class="media-body ml-3">
                                    <h5 class="heading text-warning mb-md-1">Components</h5>
                                    <p class="description d-none d-md-inline-block mb-0">Browse our 50 beautiful
                                        handcrafted components offered in the Free version.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                        <i class="ni ni-collection d-lg-none"></i>
                        <span class="nav-link-inner--text">Examples</span>
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{ asset('web') }}/examples/landing.html" class="dropdown-item">Landing</a>
                        <a href="{{ asset('web') }}/examples/profile.html" class="dropdown-item">Profile</a>
                        <a href="{{ asset('web') }}/examples/login.html" class="dropdown-item">Login</a>
                        <a href="{{ asset('web') }}/examples/register.html" class="dropdown-item">Register</a>
                    </div>
                </li>
            </ul> --}}

            @php
                // Ambil data teks Instagram dari setting pertama yang ditemukan
                $setting = \App\Models\Setting::first();
                $instagramText = $setting ? $setting->instagram : '';
                $facebookText = $setting ? $setting->facebook : '';
                $twitterText = $setting ? $setting->twitter : '';
            @endphp
            <ul class="navbar-nav align-items-lg-center ml-md-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ $facebookText }}" target="_blank" data-toggle="tooltip"
                        title="Like us on Facebook">
                        <i class="fa fa-facebook-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Facebook</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ $instagramText }}" target="_blank" data-toggle="tooltip"
                        title="Follow us on Instagram">
                        <i class="fa fa-instagram"></i>
                        <span class="nav-link-inner--text d-lg-none">Instagram</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ $twitterText }}" target="_blank" data-toggle="tooltip"
                        title="Follow us on Twitter">
                        <i class="fa fa-twitter-square"></i>
                        <span class="nav-link-inner--text d-lg-none">Twitter</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://github.com/creativetimofficial/argon-design-system" target="_blank" data-toggle="tooltip" title="Star us on Github">
              <i class="fa fa-github"></i>
              <span class="nav-link-inner--text d-lg-none">Github</span>
            </a>
          </li> --}}
                <li class="nav-item ml-md-5">
                    <a class="nav-link nav-link-icon" href="/order" data-toggle="tooltip" title="My Orders">
                        <span class="nav-link-inner--text"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                        <span class="nav-link-inner--text">My orders</span>
                    </a>
                </li>

                {{-- <li class="nav-item mr-4">
            <span class="mr-1 text-primary"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
            <a href="#" class="text-default">My orders</a>
          </li> --}}

                <li class="nav-item">
                    @if (Auth::check())
                        <!-- Jika pengguna sudah login, arahkan ke /profile -->

                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="/profil" data-toggle="tooltip" title="Profil">
                        <span class="mr-1 nav-link-inner--text"><i class="fa fa-user-circle"
                                aria-hidden="true"></i></span>
                        <span class="nav-link-inner--text">Your Account</span>
                    </a>
                </li>
            @else
                <!-- Jika pengguna belum login, arahkan ke halaman login -->
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="/login" data-toggle="tooltip" title="Profil">
                        <span class="mr-1 nav-link-inner--text"><i class="fa fa-user-circle"
                                aria-hidden="true"></i></span>
                        <span class="nav-link-inner--text">Login</span>
                    </a>
                </li>
                @endif
                </li>




            </ul>
        </div>
    </div>
</nav>
