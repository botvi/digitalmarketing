@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Tambah Sub Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('subkategori.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_sub_kategori">Nama Sub Kategori:</label>
                    <input type="text" name="nama_sub_kategori" id="nama_sub_kategori" class="form-control" required>
                    @error('nama_sub_kategori')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</section>
@endsection
