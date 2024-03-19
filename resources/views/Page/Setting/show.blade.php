@extends('template.layout')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Setting
                <a href="{{ route('setting.create') }}" class="btn btn-primary float-end">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-earmark-plus-fill me-1"></i> <!-- Ikon dengan margin kanan 1 unit -->
                        Tambah Data
                    </div>
                </a>
            </div>
            <div class="card-body">
                <table id="example" class="display nowrap">
                    <thead>
                        <tr>
                            <th>Instagram</th>
                            <th>Twitter</th>
                            <th>Facebook</th>
                            <th>Icon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $setting)
                            <tr>
                                <td>{{ $setting->instagram }}</td>
                                <td>{{ $setting->twitter }}</td>
                                <td>{{ $setting->facebook }}</td>
                                <td><img src="{{ asset($setting->icon) }}" alt="Icon" width="35" height="35">
                                </td>
                                <td>
                                    <button onclick="window.location='{{ route('setting.edit', $setting->id) }}'"
                                        class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></button>
                                    <form action="{{ route('setting.destroy', $setting->id) }}" id="deleteForm"
                                        method="POST" style="display: inline;">
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
    </section>
@endsection
