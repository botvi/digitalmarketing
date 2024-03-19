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
            background-color: #eee
        }

        @media (max-width: 1023px) {
            #section-title {
                display: none;
            }
        }

        @media (max-width: 500px) {
            .table td {
                display: block;
                width: 100%;
                text-align: left;
            }

            .table tr:first-child td:nth-child(2),
            .table tr:not(:first-child) td:nth-child(n+3) {
                margin-top: 10px;
            }

            .table tr:not(:first-child) td:nth-child(3),
            .table tr:not(:first-child) td:nth-child(4) {
                display: block;
                width: 100%;
                text-align: left;
                margin-top: 10px;
            }

        }

        .table td {
            font-weight: 600;
            font-size: 15px
        }

        /*
        .shape-image {
            background-image: url({{ asset('web/assets/img/brand/bgindex4.jpg') }});
            background-size: cover;
            background-position: center;
        } */
    </style>
</head>

<body class="index-page">
    <!-- Navbar -->
    @include('Website.navbar')
    <div class="section" style="margin-top: -30px;">
        <div class="container">
            <div class="form-group">
                <div class="input-group input-group-alternative mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                    </div>
                    <input id="searchInput" class="form-control form-control-alternative mr-2"
                        placeholder="Input name product.." type="text">

                </div>
            </div>
            <!-- Custom controls -->
            <div class="row" id="section-title" style="margin-bottom: -30px;">
                <div class="col-lg-1 col-md-6 ml-4">
                    <!-- Checkboxes -->
                    <div class="">
                        <button class="btn btn-primary btn-sm"></button>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 mr-6">
                    <!-- Checkboxes -->
                    <div class="">
                        <button class="btn btn-primary btn-sm">Name of product</button>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-6 mt-4 mt-md-0">
                    <!-- Radio buttons -->
                    <div class="">
                        <button class="btn btn-primary btn-sm">Stock</button>
                    </div>

                </div>
                <div class="col-lg-2 col-sm-6 mt-4 mt-md-0 float-right">
                    <!-- Toggle buttons -->
                    <div class="">
                        <button class="btn btn-primary btn-sm">price</button>
                    </div><label class="custom-toggle">

                </div>
            </div>
            <div class="alert alert-default searchResult" role="alert" style="display: none;">
                Search result...<i class="fa fa-search" aria-hidden="true"></i>
            </div>
            @foreach ($categories as $category)
                @foreach ($produks->where('kategori_id', $category->id)->groupBy('subkategori_id') as $subkategoriId => $produkGroup)
                    @php
                        $subkategori = \App\Models\SubKategori::find($subkategoriId);
                    @endphp
                    @if ($subkategori)
                        <div class="alert alert-default" role="alert">
                            @if ($category->icon)
                                <img src="{{ asset('/' . $category->icon) }}" alt="{{ $category->nama_kategori }}"
                                    width="30" height="30" class="mr-4">
                            @endif
                            {{ $category->nama_kategori }} || {{ $subkategori->nama_sub_kategori }}
                        </div>
                        <div class="table-responsive">
                            @if ($produkGroup->isEmpty())
                                <p>Data tidak ada</p>
                            @else
                                <table class="table">
                                    <tbody>
                                        @foreach ($produkGroup as $produk)
                                            <tr>
                                                <td>
                                                    @if ($category->icon)
                                                        <img src="{{ asset('/' . $category->icon) }}"
                                                            alt="{{ $category->nama_kategori }}" width="25"
                                                            height="25">
                                                    @endif
                                                </td>
                                                <td colspan="3" class="col-lg-7"
                                                    style="font-size: 12px; font-weight: 700;">
                                                    <a
                                                        href="{{ route('deskripsi.show', $produk->id) }}">{{ $produk->keterangan }}</a>
                                                </td>
                                                <td class="col-lg-1">{{ count($produk->produk) }} pcs.</td>
                                                <td class="col-lg-2">
                                                    @if (Auth::check())
                                                        @if (Auth::user()->currency === 'USD')
                                                            $ {{ number_format($produk->usd, 2) }}
                                                        @else
                                                            IDR {{ number_format($produk->idr) }}
                                                        @endif
                                                    @else
                                                        IDR {{ number_format($produk->idr) }} <br> $
                                                        {{ number_format($produk->usd, 2) }}
                                                    @endif
                                                </td>
                                                <td class="col-lg-2">
                                                    @if (Auth::check())
                                                        <!-- Jika pengguna sudah login, tampilkan tombol belanja -->
                                                        <a href="{{ route('beli.produk.show', ['id' => $produk->id]) }}"
                                                            class="btn btn-primary"><i class="fa fa-shopping-bag"
                                                                aria-hidden="true"></i></a>
                                                    @else
                                                        <!-- Jika pengguna belum login, tampilkan tombol belanja tetapi arahkan ke halaman login saat diklik -->
                                                        <a href="{{ route('login') }}" class="btn btn-primary"><i
                                                                class="fa fa-shopping-bag" aria-hidden="true"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    @else
                        <p>Data tidak ada</p>
                    @endif
                @endforeach
            @endforeach

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

    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('.table tbody tr').hide(); // Semua baris tabel disembunyikan terlebih dahulu
                $('.table tbody tr').filter(function() {
                    var rowText = $(this).text().toLowerCase();
                    return rowText.includes(searchText);
                }).show();

                // Menampilkan pesan jika tidak ada hasil yang cocok
                if ($('.table tbody tr:visible').length === 0) {
                    $('#noResult').show();
                } else {
                    $('#noResult').hide();
                }

                // Menyembunyikan thead jika tidak ada hasil yang cocok
                if ($('.table tbody tr:visible').length === 0) {
                    $('.table thead').hide();
                } else {
                    $('.table thead').show();
                }

                // Tampilkan elemen dengan class alert jika searchInput kosong
                if (searchText === '') {
                    $('.alert').show();
                    $('.searchResult').hide();


                } else {
                    $('.alert').hide();
                    $('.searchResult').show();

                }
            });
        });
    </script>

</body>

</html>
