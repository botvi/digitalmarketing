@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Produk
                <a href="{{ route('produk.create') }}" class="btn btn-primary float-end">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-plus-fill me-1"></i>
                        Tambah Data
                    </div>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="max-width: 100%; overflow: auto;">
                    <table id="example" class="display nowrap dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th>No.</th> --}}
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Keterangan Produk</th>
                                <th>Stok</th>
                                <th>IRD</th>
                                <th>USD</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $index => $produk)
                                <tr>
                                    {{-- <td>{{ $index + 1 }}</td> --}}
                                    <td>
                                        <a href="{{ route('produk.download', $produk->id) }}"
                                            class="btn btn-sm btn-success"><i class="bi bi-download"></i> Download</a>
                                    </td>
                                    <td>{{ $produk->kategori->nama_kategori }}</td>
                                    <td>{{ $produk->subkategori->nama_sub_kategori }}</td>
                                    <td>{{ $produk->keterangan }}</td>
                                    <td>{{ count($produk->produk) }}</td>
                                    <td>IDR {{ number_format($produk->idr) }}</td>
                                    <td>$ {{ number_format($produk->usd, 2) }}</td>
                                    <td>
                                        {{-- <button onclick="window.location='{{ route('produk.edit', $produk->id) }}'"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button> --}}
                                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
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
