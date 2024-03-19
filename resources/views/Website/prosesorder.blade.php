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
            background-color: #5957f9;
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
                <li class="breadcrumb-item"><a href="#">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proceed Order</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-text text-default">{{ $product->keterangan }}</h6>
                    </div>
                    <div class="card-body">
                        <form id="purchaseForm" method="post" action="{{ route('konfirmasi.pembelian') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group row">
                                <label for="jumlah_stok" class="col-sm-4 col-form-label">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" id="jumlah_stok" name="jumlah_stok" class="form-control"
                                        required>
                                </div>
                            </div>
                            @if (Auth::check())
                                <!-- Memeriksa apakah pengguna sedang login -->
                                @php
                                    $userCurrency = Auth::user()->currency;
                                    $price = $userCurrency == 'IDR' ? $product->idr : $product->usd;
                                @endphp
                                <div class="form-group row">
                                    <label for="price" class="col-sm-4 col-form-label">Price
                                        ({{ $userCurrency }})</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="price" name="price"
                                            value="{{ $price }} {{ $userCurrency }}" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-sm-4 col-form-label">Total
                                        ({{ $userCurrency }})</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="total" name="total" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                                <button type="button" id="confirmButton" class="btn btn-success float-right">
                                    <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> Proceed to payment
                                </button>
                            @else
                                <p class="card-text">Silakan login untuk melihat harga.</p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.getElementById('jumlah_stok').addEventListener('input', function() {
            var price = parseFloat(document.getElementById('price').value.replace(/[^\d.]/g, ''));
            var quantity = parseInt(this.value);
            var total = price * quantity;

            // Menentukan jumlah digit di belakang koma berdasarkan mata uang
            var userCurrency = "{{ Auth::check() ? Auth::user()->currency : 'USD' }}";
            var decimalPlaces = userCurrency === 'USD' ? 2 : 0;

            // Menampilkan total dengan format angka dan jumlah digit desimal yang sesuai
            document.getElementById('total').value = total.toLocaleString('en-US', {
                minimumFractionDigits: decimalPlaces,
                maximumFractionDigits: decimalPlaces
            });
        });
    </script>


    <!-- Core JS Files -->
    <script src="{{ asset('web') }}/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-switch.js"></script>
    <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/moment.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <!-- Google Maps Plugin -->
    @include('sweetalert::alert')

    <!-- Include SweetAlert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Your other script includes -->

    <script>
        document.getElementById('confirmButton').addEventListener('click', function() {
            // Get the quantity and price from the form
            var quantity = document.getElementById('jumlah_stok').value;
            var price = parseFloat(document.getElementById('price').value.replace(/[^\d.]/g, ''));
            var total = price * quantity;

            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                html: 'You will make a purchase ' + quantity + ' this product with total price ' +
                    total.toLocaleString('en-US', {
                        style: 'currency',
                        currency: '{{ $userCurrency }}'
                    }) + '.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Beli!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                // If user confirms, submit the form
                if (result.isConfirmed) {
                    document.getElementById('purchaseForm').submit();
                }
            });
        });
    </script>


</body>

</html>
