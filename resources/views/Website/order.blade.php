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
        .table-head {
            background-color: rgb(57, 58, 58);
            color: rgb(255, 255, 255);
            font-weight: 900;
            font-size: 15px;
        }

        .table-body {
            color: #000;
            font-weight: 800;
            font-size: 10px;
        }

        .price-quantity {
            display: flex;
            flex-direction: column;
        }

        .price-quantity>div {
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
        }

        .data {
            color: #333;
            /* Warna teks untuk data */
        }
    </style>

</head>

<body class="index-page">
    <!-- Navbar -->
    @include('Website.navbar')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped" style="width:100%">
                <thead class="table-head">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Goods</th>
                        <th>Download</th>
                        <th>About</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($orders as $order)
                        <tr>
                            <td> {{ $order->id }}</small></td>
                            <td> {{ $order->nama_kategori }}</small></td>
                            <td> {{ $order->keterangan }}</small></td>
                            <td>
                                <a href="{{ route('download', $order->id) }}" class="badge badge-primary"><i
                                        class="fa fa-download" aria-hidden="true"></i> Download</a>
                            </td>
                            <td>
                                <div class="price-quantity">
                                    <div class="label">Price:</div>
                                    <div class="data">{{ number_format($order->harga) }}</div>
                                </div>
                                <div class="price-quantity">
                                    <div class="label">Quantity:</div>
                                    <div class="data">{{ count(json_decode($order->produk)) }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-success ">Paid</div>
                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>

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
    @include('sweetalert::alert')


</body>

</html>
