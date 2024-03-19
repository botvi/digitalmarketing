@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                History Orders
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-width: 100%; overflow: auto;">
                    <table id="example" class="display nowrap dt-responsive" style="width:100%">
                        <thead>
                            <tr>

                                <th>USER</th>
                                <th>KATEGORI</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                <th>PRODUK</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminorder as $adminorders)
                                <tr>
                                    <td>{{ $adminorders->user->name }}</td>
                                    <td>{{ $adminorders->nama_kategori }}</td>
                                    <td>
                                        @if ($adminorders->user->currency === 'USD')
                                            $ {{ $adminorders->harga }}
                                        @else
                                            IDR {{ number_format($adminorders->harga) }}
                                        @endif
                                    </td>
                                    <td><span class="badge bg-success"><i class="bi bi-bag-check-fill"></i> Success</span>
                                    </td>
                                    <td>{{ $adminorders->keterangan }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
