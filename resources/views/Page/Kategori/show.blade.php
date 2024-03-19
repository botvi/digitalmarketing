@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Kategori
                <a href="{{ route('categories.create') }}" class="btn btn-primary float-end">
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
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    @if ($category->icon)
                                        <img src="{{ asset('/' . $category->icon) }}" alt="{{ $category->nama_kategori }}"
                                            width="50" height="50">
                                    @endif
                                </td>
                                <td>
                                    {{ $category->nama_kategori }}
                                </td>
                                <td>
                                    <button onclick="window.location='{{ route('categories.edit', $category->id) }}'"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="bi bi-trash"></i></button>
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
