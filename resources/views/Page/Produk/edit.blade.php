@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Update Produk
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kategori_id">Kategori:</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subkategori_id">Sub Kategori:</label>
                    <select name="subkategori_id" id="subkategori_id" class="form-control" required>
                        <option value="">Pilih Sub Kategori</option>
                        @foreach($subkategoris as $subkategori)
                            <option value="{{ $subkategori->id }}" {{ $produk->subkategori_id == $subkategori->id ? 'selected' : '' }}>{{ $subkategori->nama_sub_kategori }}</option>
                        @endforeach
                    </select>
                    @error('subkategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $produk->keterangan }}" required>
                    @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group with-title mb-3">
                    <textarea class="form-control"  name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan produk"
                        rows="3" required>{{ $produk->keterangan }}</textarea>
                    <label for="keterangan">KETERANGAN PRODUK</label>
                    @error('keterangan')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                {{-- <div class="form-group">
                    <label for="produk">Produk:</label>
                    <input type="text" name="produk" id="produk" class="form-control" value="{{ $produk->produk }}" required>
                    @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group with-title mb-3">
                    <textarea class="form-control"  name="produk" id="produk" class="form-control" placeholder="Informasi produk seperti detail akun dan lain lain"
                        rows="3" required>{{ $produk->produk }}</textarea>
                    <label for="produk">INFROMASI PRODUK</label>
                    @error('produk')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="{{ $produk->stok }}" required>
                    @error('stok')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="idr">Harga (IDR):</label>
                    <input type="number" name="idr" id="idr" class="form-control" value="{{ $produk->idr }}" required placeholder="Inputkan nominal tanpa titik atau koma">
                    @error('idr')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#kategori_id').change(function() {
            var kategori_id = $(this).val();
            if (kategori_id) {
                $.ajax({
                    url: '/get-sub-kategoris/' + kategori_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#subkategori_id').empty();
                        $('#subkategori_id').append('<option value="">Pilih Sub Kategori</option>');
                        $.each(data, function(i, item) {
                            $('#subkategori_id').append('<option value="' + item.id + '">' + item.nama_sub_kategori + '</option>');
                        });
                    }
                });
            } else {
                $('#subkategori_id').empty();
            }
        });
    });
</script>
@endsection
