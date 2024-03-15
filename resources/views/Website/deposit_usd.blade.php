<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('web') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('web') }}/assets/img/favicon.png">
    <title>{{ env('APP_NAME') }}</title>
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
            background: #5957f9;
        }

        .saldo {
            border-radius: 25px;
            padding: .75rem 1.25rem;
            position: relative;
            cursor: pointer;
            width: 100%;
            height: 100%;
            background-color: #eee;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQeObnh7emJY2EW4AYP0SAHy-8H9GfXVryG3A&usqp=CAU');
            background-size: cover;
            /* Atur ukuran gambar agar menutupi seluruh area */
            background-position: center;
            /* Atur posisi gambar ke tengah */
            transition: border-color 0.3s, box-shadow 0.3s;
            /* Transisi untuk border-color dan box-shadow */
        }

        .saldo:hover {
            background-color: #f8f9fa;
        }

        .saldo.active {
            border-color: rgb(44, 44, 44);
            border-width: 5px;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }


        /* Hide the radio input */
        input[type="radio"] {
            display: none;
        }

        .text-saldo {
            font-size: 30px;
            margin-top: 30px;
            font-weight: 900;
            color: rgb(44, 44, 44);
        }

        .container-deposit {
            width: 100%;
            padding: 100px;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        .text-funds {
            font-weight: 800;
            color: rgb(255, 255, 255);
        }

        /* CSS untuk mengubah latar belakang menjadi warna ketika saldo aktif */
        .saldo.active {
            background-image: none;
            /* Menghapus gambar latar belakang */
            background-color: #e2e2e2;
            /* Menetapkan warna latar belakang */
            /* Transisi jika diperlukan */
            transition: background-color 0.3s;
        }
    </style>
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('website.navbar')

    <div class="container container-deposit mt-4">
        <form action="{{ route('paypal') }}" method="post">
            @csrf
            <h1 class="text-center text-funds text-uppercase">choose how much funds</h1>
            <div class="row">

                @foreach ($daftarSaldos as $saldo)
                    <div class="col-md-6 col-lg-4 col-saldo mt-4">
                        <label class="saldo mb-3" id="saldo-{{ $saldo->id }}"
                            onclick="selectSaldo('{{ $saldo->id }}', '{{ $saldo->usd }}')">
                            <input type="radio" name="selectedSaldo" value="{{ $saldo->usd }}">
                            <h6 class="text-saldo text-center p-2">$ {{ $saldo->usd }}</h6>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                <button class="btn btn-secondary float-right" type="submit"
                    style="font-style: italic; font-weight:900;">Pay with <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png"
                        alt="" srcset="" width="70px" height="auto">
                </button>
            </div>
        </form>
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

    <script>
        function selectSaldo(id, usd) {
            // Remove active class from all balances
            $(".saldo").removeClass('active');
            // Add active class to the selected balance
            $("#saldo-" + id).addClass('active');
            // Find the associated radio input and mark as checked
            $("input[name=selectedSaldo]").prop('checked', false);
            $("input[name=selectedSaldo][value='" + usd + "']").prop('checked', true);

            // Scroll to the bottom of the page
            window.scrollTo(0, document.body.scrollHeight);
        }
    </script>


</body>

</html>
