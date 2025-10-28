@extends('dummylayouts.app')

@section('content')
<h2>Create Program</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('data-programs.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
    @csrf

    <div style="margin-bottom: 15px;">
        <label for="judul" style="display: block; font-weight: bold;">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="sub_judul" style="display: block; font-weight: bold;">Sub Judul:</label>
        <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="deskripsi" style="display: block; font-weight: bold;">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('deskripsi') }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="waktu_pelaksanaan" style="display: block; font-weight: bold;">Waktu Pelaksanaan:</label>
        <input type="date" name="waktu_pelaksanaan" id="waktu_pelaksanaan" value="{{ old('waktu_pelaksanaan') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tahun_anggaran" style="display: block; font-weight: bold;">Tahun Anggaran:</label>
        <input type="number" name="tahun_anggaran" id="tahun_anggaran" value="{{ old('tahun_anggaran') }}"
               min="2000" max="{{ date('Y') + 5 }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="lokasi" style="display: block; font-weight: bold;">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="status_proyek" style="display: block; font-weight: bold;">Status Proyek:</label>
        <select name="status_proyek" id="status_proyek"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Status --</option>
            @foreach (['Perencanaan', 'Berjalan', 'Selesai', 'Ditunda'] as $status)
                <option value="{{ $status }}" {{ old('status_proyek') == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>


    <div style="margin-bottom: 15px;">
        <label for="dokumentasi" style="display: block; font-weight: bold;">Dokumentasi (multiple files):</label>
        <input type="file" name="dokumentasi[]" id="dokumentasi" multiple
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="dokumentasi" style="display: block; font-weight: bold;">Dokumentasi (multiple images):</label>
        <input type="file" name="dokumentasi[]" id="dokumentasi" multiple accept="image/*"
            style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>


    <div style="margin-bottom: 15px;">
        <label for="kategori_id" style="display: block; font-weight: bold;">Kategori:</label>
        <select name="kategori_id" id="kategori_id"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>


    <button type="submit"
            style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        💾 Save Program
    </button>
</form>
@endsection
