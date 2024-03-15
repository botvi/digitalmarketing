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
            background-color: #5957f9;
        }

        .card {
            background-color: #fff;
            width: 580px;
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 2rem !important;
        }

        .card {
            background-image: url('https://img.freepik.com/free-vector/white-elegant-texture-background_23-2148446112.jpg?size=626&ext=jpg&ga=GA1.1.2116175301.1701388800&semt=ais');
            background-size: cover;
            /* Atur ukuran gambar agar menutupi seluruh area */
            background-position: center;
            /* Atur posisi gambar ke tengah */
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .text-paid {
            color: #65B741;
            font-weight: 900;
        }
    </style>
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('website.navbar')

    <div class="container d-flex justify-content-center mt-5">
        <div class="card">
            <div class="d-flex justify-content-between">
                <span class="font-weight-bold">invoice#{{ $paymentId }}</span>
                <h3 class="text-paid text-right font-weight-bold">PAID</h3>
            </div>
            <span class="text-primary" id="formattedDate"></span>
            <div class="card-body">


            </div>
            <span class="text-center">TOTAL FUNDS</span>
            <h2 class="text-center">$ {{ $amount }}</h2>
            <span class="text-center">Top up your balance on the <b>Encorejuene</b> website</span>
            <span class="text-center mt-5">Thank you for your payment</span>
        </div>
    </div>

    <center><a href="/deposit_usd" class="btn btn-danger mt-4">BACK</a></center>



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

    <script>
        // Mendapatkan tanggal saat ini
        var date = new Date();

        // Mendapatkan tanggal, bulan, dan tahun
        var day = date.getDate();
        var month = date.getMonth() + 1; // Bulan dimulai dari indeks 0, jadi kita tambahkan 1
        var year = date.getFullYear();

        // Membuat string format dengan memastikan bahwa angka-angka di depan bulan dan tanggal memiliki dua digit
        var formattedDate = (day < 10 ? '0' : '') + day + '/' + (month < 10 ? '0' : '') + month + '/' + year;

        // Menampilkan tanggal dalam format yang diinginkan
        document.getElementById("formattedDate").innerHTML = formattedDate;
    </script>

</body>

</html>
