@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Tambah Data Setting
            </div>
            <div class="card-body">
                <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="instagram">Instagram:</label>
                        <input type="text" name="instagram" id="instagram" class="form-control"
                            placeholder="Masukkan akun Instagram">
                        @error('instagram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter:</label>
                        <input type="text" name="twitter" id="twitter" class="form-control"
                            placeholder="Masukkan akun Twitter">
                        @error('twitter')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="facebook">Facebook:</label>
                        <input type="text" name="facebook" id="facebook" class="form-control"
                            placeholder="Masukkan akun Facebook">
                        @error('facebook')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="icon">Logo Brand *Wajib :</label>
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
