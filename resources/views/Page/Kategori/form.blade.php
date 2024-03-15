@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Tambah Kategori
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori:</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    @error('nama_kategori')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="icon">Icon Kategori:</label>
                    <input type="file" name="icon" id="icon" class="form-control-file">
                    @error('icon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</section>
@endsection
