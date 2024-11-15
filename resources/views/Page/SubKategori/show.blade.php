@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Sub Kategori
                <a href="{{ route('subkategori.create') }}" class="btn btn-primary float-end">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-plus-fill me-1"></i>
                        Tambah Data
                    </div>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-width: 100%; overflow: auto;">
                    <table id="example" class="display nowrap">
                        <thead>
                            <tr>
                                <th>Nama Sub Kategori</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subKategoris as $subKategori)
                                <tr>
                                    <td>{{ $subKategori->nama_sub_kategori }}</td>
                                    <td>{{ $subKategori->kategori->nama_kategori }}</td>
                                    <td>{{ $subKategori->keterangan }}</td>
                                    <td>
                                        <button
                                            onclick="window.location='{{ route('subkategori.edit', $subKategori->id) }}'"
                                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i> </button>
                                        <form action="{{ route('subkategori.destroy', $subKategori->id) }}" method="POST"
                                            style="display: inline;" id="deleteForm">
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
        </div>
    </section>
@endsection
