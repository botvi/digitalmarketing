@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Tambah Produk
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kategori_id">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
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
                        </select>
                        @error('subkategori_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mb5">
                        <textarea name="deskripsi" id="deskripsi"></textarea>
                    </div>
                    {{-- <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    @error('keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                    <div class="form-group with-title mb-3">
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan produk" rows="3"
                            required></textarea>
                        <label for="keterangan">KETERANGAN PRODUK</label>
                        @error('keterangan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                    <label for="produk">Produk:</label>
                    <input type="text" name="produk" id="produk" class="form-control" required>
                    @error('produk')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                    <div id="produkakun-container" class="mb-5">
                        <div class="produkakun-input">
                            <label for="produkakun" class="form-label">Produk Akun:</label>
                            <input type="text" id="produk" name="produk[]" class="form-control bg-warning" required
                                placeholder="ex* Email:xxxxxxx, Password:xxxxxxxxx" style="height: 100px;">

                        </div>
                    </div>

                    <!-- Tombol untuk menambah inputan produk akun -->
                    <button type="button" id="add-produkakun" class="btn btn-primary mb-2">Tambah Produk Akun</button>


                    <div class="form-group mb5">
                        <label for="idr">Harga (IDR):</label>
                        <input type="number" name="idr" id="idr" class="form-control" required
                            placeholder="Inputkan nominal tanpa titik atau koma">
                        @error('idr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        document.getElementById('add-produkakun').addEventListener('click', function() {
            var container = document.getElementById('produkakun-container');
            var newInput = document.createElement('div');
            newInput.classList.add('produkakun-input', 'mb-3');
            newInput.innerHTML = `
            <label for="produkakun" class="form-label">Produk Akun:</label>
            <input type="text" id="produk" name="produk[]" class="form-control bg-warning" required
                                placeholder="ex* Email:xxxxxxx, Password:xxxxxxxxx" style="height: 100px;">
        `;
            container.appendChild(newInput);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#kategori_id').change(function() {
                var kategori_id = $(this).val();
                if (kategori_id) {
                    $.ajax({
                        url: 'get-sub-kategoris/' + kategori_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#subkategori_id').empty();
                            $('#subkategori_id').append(
                                '<option value="">Pilih Sub Kategori</option>');
                            $.each(data, function(i, item) {
                                $('#subkategori_id').append('<option value="' + item
                                    .id + '">' + item.nama_sub_kategori +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#subkategori_id').empty();
                }
            });
        });
    </script>

    <script>
        $('#deskripsi').summernote({
            placeholder: 'Description product',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
