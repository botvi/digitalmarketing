@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Edit Sub Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('subkategori.update', $subKategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_sub_kategori">Nama Sub Kategori:</label>
                    <input type="text" name="nama_sub_kategori" id="nama_sub_kategori" class="form-control" value="{{ $subKategori->nama_sub_kategori }}" required>
                    @error('nama_sub_kategori')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $subKategori->kategori_id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $subKategori->keterangan }}" required>
                    @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</section>
@endsection
