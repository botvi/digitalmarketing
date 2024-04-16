@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Daftar Users

            </div>
            <div class="card-body">
                <table id="example" class="display nowrap">
                    <thead>
                        <tr>

                            <th>Nama</th>
                            <th>Email</th>
                            <th>Currency</th>
                            <th>Balance</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                            <tr>

                                <td>
                                    {{ $users->name }}
                                    @if ($users->role === 'admin')
                                        <span class="badge bg-success">{{ $users->role }}</span>
                                    @elseif ($users->role === 'user')
                                        <span class="badge bg-primary">{{ $users->role }}</span>
                                    @endif
                                </td>

                                <td>{{ $users->email }}</td>
                                <td>{{ $users->currency }}</td>
                                <td>
                                    @if ($users->currency === 'USD' && ($users->balance_usd !== null && $users->balance_usd !== 0))
                                        <span class="badge bg-success">$ {{ number_format($users->balance_usd) }}</span>
                                    @elseif($users->currency === 'IDR' && ($users->balance_idr !== null && $users->balance_idr !== 0))
                                        <span class="badge bg-success">IDR {{ number_format($users->balance_idr) }}</span>
                                    @else
                                        <span class="badge bg-secondary">No balance</span>
                                    @endif
                                </td>



                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
