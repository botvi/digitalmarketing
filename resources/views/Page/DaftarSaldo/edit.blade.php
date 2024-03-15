@extends('template.layout')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Update Daftar Saldo
        </div>
        <div class="card-body">
            <form action="{{ route('daftarsaldo.update', $daftarsaldo->id) }}" method="POST">
                @csrf
                @method('PUT')
              
                <div class="form-group">
                    <label for="idr">SALDO (IDR):</label>
                    <input type="number" name="idr" id="idr" class="form-control" value="{{ $daftarsaldo->idr }}" required placeholder="Inputkan nominal tanpa titik atau koma">
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