@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Update Produk
            </div>
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kategori_id">Kategori:</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}</option>
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
                            @foreach ($subkategoris as $subkategori)
                                <option value="{{ $subkategori->id }}"
                                    {{ $produk->subkategori_id == $subkategori->id ? 'selected' : '' }}>
                                    {{ $subkategori->nama_sub_kategori }}</option>
                            @endforeach
                        </select>
                        @error('subkategori_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb5">
                        <textarea name="deskripsi" id="deskripsi">{{ $produk->deskripsi }}</textarea>
                    </div>
                    <div class="form-group with-title mb-3">
                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan produk" rows="3"
                            required>{{ $produk->keterangan }}</textarea>
                        <label for="keterangan">KETERANGAN PRODUK</label>
                        @error('keterangan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="form-group mb-5">
                        <label for="idr">Format Akun:</label>
                        <input type="number" name="idr" id="idr" class="form-control" required
                            placeholder="Format akun" value="Format A">
                        @error('idr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group with-title mb-3">
                        <textarea class="form-control" name="produk" id="produk" placeholder="Produk" rows="3" required>{{ implode(',', $produk->produk) }}</textarea>
                        <label for="produk">PRODUK</label>
                        @error('produk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="idr">Harga (IDR):</label>
                        <input type="number" name="idr" id="idr" class="form-control" required
                            placeholder="Inputkan nominal tanpa titik atau koma" value="{{ $produk->idr }}">
                        @error('idr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-5" id="gambarContainer">
                        <label for="gambar">Gambar Produk:</label>
                        <div id="gambarInputs">
                            <div class="input-group mt-2" id="gambarInputGroup0">
                                <input type="file" name="gambar[]" id="gambar0" class="form-control" multiple>
                                <button type="button" class="btn btn-danger remove-input">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2" id="addImageButton">Tambah Gambar</button>
                        @error('gambar.*')
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

            // Summernote initialization
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

            // Counter for input file
            let inputFileCounter = 1;

            // Function to add new input file
            function addInputFile() {
                let newInputFile =
                    `<div class="input-group mt-2" id="gambarInputGroup${inputFileCounter}">
                    <input type="file" name="gambar[]" id="gambar${inputFileCounter}" class="form-control" multiple>
                    <button type="button" class="btn btn-danger remove-input">Hapus</button>
                </div>`;
                $('#gambarContainer').append(newInputFile);
                inputFileCounter++;
            }

            // Event listener for "Tambah Gambar" button
            $('#addImageButton').click(function() {
                addInputFile();
            });

            // Event delegation for removing input fields
            $('#gambarContainer').on('click', '.remove-input', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endsection
