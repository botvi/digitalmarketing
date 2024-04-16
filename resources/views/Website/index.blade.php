<!--
=========================================================
* Argon Design System - v1.2.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
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
    <!--     Fonts and icons     -->
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
            background-color: #5957f9
        }



        .shape-image {
            background-image: linear-gradient(to left, #a2a0fd, #5957f9);
        }


        #webcoderskull {
            position: absolute;
            left: 0;
            top: 50%;
            padding: 0 20px;
            width: 100%;
            text-align: center;
            margin-top: -1000px;
        }

        canvas {
            height: 48vh;

        }

        #webcoderskull h1 {
            letter-spacing: 5px;
            font-size: 5rem;
            font-family: 'Roboto', sans-serif;
            text-transform: uppercase;
            font-weight: bold;
        }

        .card-image {
            position: relative;
            overflow: hidden;
            border-radius: 10%;
            transition: transform 0.3s ease;

        }

        .card-image:hover {
            transform: scale(1.05);
            background: linear-gradient(to top, rgba(0, 0, 0, 0.637), transparent);
            /* Perbaikan gradient */
            transition: all 0.3s ease;
            border: 3px solid #FBA834;
            /* Tambahkan border saat hover */
        }

        .card-image:hover .card-title {
            transform: translateY(-8%);
            opacity: 1;
            transition: all 0.2s ease;
        }

        .card-image:hover img {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }

        .card-title {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            color: #fff;
            padding: 10px;
            margin: 0;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .image-carousel {
            border-radius: 10px;
            /* Menambahkan radius sudut 10px */
        }
    </style>
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('Website.navbar')

    <!-- End Navbar -->
    <div class="wrapper">
        <div class="section section-hero section-shaped">
            <div class="shape shape-style-1 shape-image">
                <div id="particles">
                    <div id="webcoderskull"></div>
                </div>
            </div>
            <div class="page-header">
                <div class="container shape-container d-flex align-items-center justify-content-center">
                    <div class="col-lg-12 px-0 text-center">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <!-- Carousel slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://www.bangjeff.com/_next/image?url=https%3A%2F%2Fcdn.bangjeff.com%2F10245926-3cbf-4cbe-adb5-e64e3db0b84f.webp&w=1920&q=75"
                                        class="d-block w-100 image-carousel" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <!-- Your caption here -->
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://www.bangjeff.com/_next/image?url=https%3A%2F%2Fcdn.bangjeff.com%2Fab5de4aa-94f8-4c38-af2f-8d885c77e2bf.webp&w=1920&q=75"
                                        class="d-block w-100 image-carousel" alt="Second slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <!-- Your caption here -->
                                    </div>
                                </div>
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div> --}}
        </div>
    </div>
    <div class="section" style="margin-top: -50px;">

        <div class="container">
            <h4 class="text-white mb-4">🔥Kategori</h4>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6 col-6 mb-3">
                        <a href="{{ route('produkkategori', ['id' => $category->id]) }}" class="card-link">
                            <div class="card card-image">
                                <div class="card-body">
                                    <img src="{{ asset($category->icon) }}" alt="Category Icon" class="img-fluid">
                                    <!-- Menambahkan kelas img-fluid untuk membuat gambar responsif -->
                                    <!-- Isi dari setiap kartu (card) -->
                                    <h6 class="card-title text-center">{{ $category->nama_kategori }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>



    </div>


    </div>

    <script src="{{ asset('web') }}/assets/js/custom.js" type="text/javascript"></script>
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





</body>

</html>
