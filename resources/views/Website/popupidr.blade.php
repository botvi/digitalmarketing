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
            background-color: #5957f9;
        }
    </style>

</head>

<body class="index-page">
    <!-- Navbar -->
    @include('website.navbar')



    <div id="snap-form"></div>

    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- your HTML code -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $snapToken }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Include axios library -->

    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                Swal.fire('Success', 'Pembayaran berhasil', 'success');
                updateTransactionStatus(result.order_id);
            },
            onPending: function(result) {
                Swal.fire('Info', 'Pembayaran dalam proses', 'info');
                updateTransactionStatus(result.order_id);
            },
            onError: function(result) {
                Swal.fire('Error', 'Pembayaran gagal', 'error');
                updateTransactionStatus(result.order_id);
                window.location.href = '/deposit_idr';

            },
            onClose: function(result) {
                Swal.fire({
                    title: 'Info',
                    text: 'Pembayaran ditutup',
                    icon: 'info',
                    timer: 2000, // Menampilkan pesan selama 3 detik
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                    // Setelah 3 detik, arahkan pengguna ke /deposit_idr
                    window.location.href = '/deposit_idr';
                });
            }

        });

        function updateTransactionStatus(orderId) {
            axios.get('/deposit/' + orderId + '/status')
                .then(function(response) {
                    // Swal.fire('Success', response.data.message, 'success'); // Tampilkan pesan dari server
                    // Redirect ke route /deposit_idr setelah pembaruan status
                    window.location.href = '/deposit_idr';
                })
                .catch(function(error) {
                    Swal.fire('Error', 'Gagal mengambil status transaksi', 'error');
                    console.error('Error:', error);
                });
        }
    </script>






















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
