@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Data Daftar Saldo
            <a href="{{ route('daftarsaldo.create') }}" class="btn btn-primary float-end">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-plus-fill me-1"></i> <!-- Ikon dengan margin kanan 1 unit -->
                    Tambah Data
                </div>
            </a>
        </div>
        <div class="card-body">
            <table id="example" class="display nowrap">
                <thead>
                    <tr>
                        
                        <th>IRD</th>
                        <th>USD</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarsaldo as $daftarsaldo)
                    <tr>
                      
                        <td>IDR {{ number_format($daftarsaldo->idr) }}</td>
                        <td>$ {{ number_format($daftarsaldo->usd, 2) }}</td>
                       
                        <td>
                            <button onclick="window.location='{{ route('daftarsaldo.edit', $daftarsaldo->id) }}'" class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>
                            <form action="{{ route('daftarsaldo.destroy', $daftarsaldo->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')"><i class="bi bi-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
