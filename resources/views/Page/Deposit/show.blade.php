@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#usdTab">HISTORY USD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#idrTab">HISTORY IDR</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="usdTab" class="container tab-pane active">
                        <table id="usd-table" class="display nowrap table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Payment ID</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depositsUsd as $depositUsd)
                                    <tr>
                                        <td>{{ $depositUsd->user->name }}</td>
                                        <td>{{ $depositUsd->payment_id }}</td>
                                        <td>$ {{ number_format($depositUsd->amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $depositUsd->payment_status == 'COMPLETED' ? 'success' : 'danger' }}">
                                                {{ strtolower($depositUsd->payment_status) }}
                                            </span>
                                        </td>
                                        <td>{{ $depositUsd->payment_method }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="idrTab" class="container tab-pane fade">
                        <table id="idr-table" class="display nowrap table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Payment ID</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depositsIdr as $depositIdr)
                                    <tr>
                                        <td>{{ $depositIdr->user->name }}</td>
                                        <td>{{ $depositIdr->payment_id }}</td>
                                        <td>IDR {{ number_format($depositIdr->amount) }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $depositIdr->payment_status == 'settlement' ? 'success' : 'danger' }}">
                                                {{ strtolower($depositIdr->payment_status) }}
                                            </span>
                                        </td>
                                        <td>{{ $depositIdr->payment_method }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
