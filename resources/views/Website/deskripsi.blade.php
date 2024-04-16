<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('web') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('web') }}/assets/img/favicon.png">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('web') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('web') }}/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('web') }}/assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
    <style>
        body {
            background-color: #F2F2F2;
        }

        /* Memberikan jarak atas pada container */
        .custom-container {
            margin-top: 50px;
            /* Atur sesuai kebutuhan */
        }

        /* Memberikan warna pada card */
        .custom-card {
            background-color: #ffffff;
            border-radius: 15px;
            /* Warna latar belakang card */
        }

        .custom-text {
            font-weight: 800;
        }

        .custom-keterangan {
            font-size: 20px;
            font-weight: 800;
        }
    </style>
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('Website.navbar')

    <!-- Container dengan jarak atas yang disesuaikan -->
    <div class="container custom-container">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Deskripsi</li>
            </ol>
        </nav>
        <h5 class="card-title custom-keterangan">{{ $produk->keterangan }}</h5>

        <div class="row">
            <!-- Grid Pertama (Kolom 3) -->
            <div class="col-md-3 mb-5">
                <div class="card custom-card">
                    <div class="card-body">
                        <!-- Konten Card Grid Pertama -->
                        <h5 class="card-title text-center">
                            <img src="{{ asset($kategori->icon) }}" alt="{{ $kategori->nama_kategori }}"
                                class="img-fluid d-block mx-auto" style="max-width: 100px;">
                        </h5>


                        <p class="card-text">
                            @if ($produk->produk)
                                <span class="custom-text"> In stock </span> <br><b> {{ count($produk->produk) }}
                                    pcs.</b>
                            @else
                                <b>Stock information not available</b>
                            @endif
                        </p>
                        <p class="card-text">
                            @if (Auth::check() && Auth::user()->currency === 'IDR')
                                <span class="custom-text"> Price for each </span><br><b> from IDR
                                    {{ $produk->idr }}</b>
                            @elseif(Auth::check() && Auth::user()->currency === 'USD')
                                <span class="custom-text"> Price for each </span><br><b>from $ {{ $produk->usd }}</b>
                            @else
                                <!-- Tampilkan harga default, misalnya IDR -->
                                <span class="custom-text"> Price for each </span><br><b>from
                                    {{ number_format($produk->idr) }} /
                                    {{ $produk->usd }}</b>
                            @endif
                        </p>
                        <p class="card-text text-center">
                            @if (Auth::check())
                                <a href="{{ route('beli.produk.show', ['id' => $produk->id]) }}"
                                    class="btn btn-success"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    Buy</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success"><i class="fa fa-shopping-bag"
                                        aria-hidden="true"></i> Buy</a>
                            @endif
                        </p>


                    </div>
                </div>
            </div>

            <!-- Grid Kedua (Kolom 9) -->
            <div class="col-md-9 mb-5">
                <div class="card custom-card">
                    <div class="card-body">
                        <!-- Konten Card Grid Kedua -->
                        <p class="card-title text-default custom-text">Description</p>
                        <p class="card-text">{!! $produk->deskripsi !!}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('web') }}/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/moment.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
</body>

</html>
