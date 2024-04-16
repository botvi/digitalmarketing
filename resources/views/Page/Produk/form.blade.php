@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Tambah Produk
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="form-group with-title mb-3">
                        <textarea class="form-control" name="produk" id="produk"
                            placeholder="ex* Email:xxxxxxx Password:xxxxxxxxx,Email:xxxxxxx Password:xxxxxxxxx NOTE : PISAHHKAN AKUN DENGAN KOMA"
                            rows="3" required></textarea>
                        <label for="produk">PRODUK</label>
                        @error('produk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>





                    <div class="form-group mb-5">
                        <label for="idr">Harga (IDR):</label>
                        <input type="number" name="idr" id="idr" class="form-control" required
                            placeholder="Inputkan nominal tanpa titik atau koma">
                        @error('idr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group mb-5" id="gambarContainer">
                        <label for="gambar">Gambar Produk:</label>
                        <div id="gambarInputs">
                            <div class="input-group mb-2">
                                <input type="file" name="gambar[]" class="form-control" accept="image/*"
                                    style="width: 50%">
                                <button type="button" class="remove-input btn btn-danger ml-2">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="tambahInput">Tambah Gambar</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
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
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahInputBtn = document.getElementById('tambahInput');
            const gambarInputs = document.getElementById('gambarInputs');

            tambahInputBtn.addEventListener('click', function() {
                const newInput = document.createElement('div');
                newInput.classList.add('input-group', 'mb-2');
                newInput.innerHTML = `
                <input type="file" name="gambar[]" class="form-control" accept="image/*" style="width: 50%" required>
                <button type="button" class="remove-input btn btn-danger ml-2">Hapus</button>
            `;
                gambarInputs.appendChild(newInput);
            });

            gambarInputs.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-input')) {
                    event.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
