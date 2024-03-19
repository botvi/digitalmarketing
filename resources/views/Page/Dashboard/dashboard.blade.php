@extends('template.layout')

@section('content')
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4" style="height: 100px;">
                                        <div class="stats-icon purple">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Users</h6>
                                        <h6 class="font-extrabold mb-0">{{ $userCount }} Users</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4" style="height: 100px;">
                                        <div class="stats-icon blue">
                                            <i class="bi bi-bag-check-fill"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Orders</h6>
                                        <h6 class="font-extrabold mb-4"><span class="badge bg-primary">$
                                                {{ $totalPriceUSD }}</span> </h6>

                                        <h6 class="font-extrabold mb-0"><span class="badge bg-primary">IDR
                                                {{ $totalPriceIDR }}</span> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4" style="height: 100px;">
                                        <div class="stats-icon green">
                                            <i class="bi bi-cash-stack"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Deposit</h6>
                                        <h6 class="font-extrabold mb-4"><span class="badge bg-primary">$
                                                {{ $totalDepositUSD }}</span> </h6>
                                        <h6 class="font-extrabold mb-o"><span class="badge bg-primary">IDR
                                                {{ number_format($totalDepositIDR) }}</span> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4" style="height: 100px;">
                                        <div class="stats-icon red">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Produks</h6>
                                        <h6 class="font-extrabold mb-0">{{ $productCount }} Produk <br> <span
                                                class="badge bg-success">Available</span> </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-body py-4 px-5">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl">
                                <img src="{{ asset('dist') }}/assets/images/faces/1.jpg" alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                                <h6 class="text-muted mb-0">{{ auth()->user()->email }}</h6>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <a href="/" class="btn btn-success">Visit the shop</a>
        </section>
    </div>
@endsection
