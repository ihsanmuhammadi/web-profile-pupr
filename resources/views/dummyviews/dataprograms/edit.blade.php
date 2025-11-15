@extends('dummylayouts.app')

@section('content')
<h2>Edit Program</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('data-programs.update', $dataProgram->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="judul" style="display: block; font-weight: bold;">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $dataProgram->judul) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="sub_judul" style="display: block; font-weight: bold;">Sub Judul:</label>
        <input type="text" name="sub_judul" id="sub_judul" value="{{ old('sub_judul', $dataProgram->sub_judul) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="deskripsi" style="display: block; font-weight: bold;">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('deskripsi', $dataProgram->deskripsi) }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="waktu_mulai" style="display: block; font-weight: bold;">Waktu Mulai:</label>
        <input type="date" name="waktu_mulai" id="waktu_mulai"
               value="{{ old('waktu_mulai', $dataProgram->waktu_mulai) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="waktu_selesai" style="display: block; font-weight: bold;">Waktu Selesai:</label>
        <input type="date" name="waktu_selesai" id="waktu_selesai"
               value="{{ old('waktu_selesai', $dataProgram->waktu_selesai) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tahun_anggaran" style="display: block; font-weight: bold;">Tahun Anggaran:</label>
        <input type="number" name="tahun_anggaran" id="tahun_anggaran"
               value="{{ old('tahun_anggaran', $dataProgram->tahun_anggaran) }}"
               min="2000" max="{{ date('Y') + 5 }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="lokasi" style="display: block; font-weight: bold;">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $dataProgram->lokasi) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="kecamatan" style="display: block; font-weight: bold;">Kecamatan:</label>
        <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', $dataProgram->kecamatan) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="status_proyek" style="display: block; font-weight: bold;">Status Proyek:</label>
        <select name="status_proyek" id="status_proyek"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Status --</option>
            @foreach (['Perencanaan', 'Berjalan', 'Selesai', 'Ditunda'] as $status)
                <option value="{{ $status }}" {{ old('status_proyek', $dataProgram->status_proyek) == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="dokumentasi" style="display: block; font-weight: bold;">Dokumentasi:</label>
        <input type="text" name="dokumentasi" id="dokumentasi" value="{{ old('dokumentasi', $dataProgram->dokumentasi) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="kategori_id" style="display: block; font-weight: bold;">Kategori:</label>
        <select name="kategori_id" id="kategori_id"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('kategori_id', $dataProgram->kategori_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tenaga_kerja_1" style="display: block; font-weight: bold;">Tenaga Kerja 1:</label>
        <input type="text" name="tenaga_kerja_1" id="tenaga_kerja_1"
               value="{{ old('tenaga_kerja_1', $dataProgram->tenaga_kerja_1) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="posisi_1" style="display: block; font-weight: bold;">Posisi 1:</label>
        <input type="text" name="posisi_1" id="posisi_1"
               value="{{ old('posisi_1', $dataProgram->posisi_1) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="tenaga_kerja_2" style="display: block; font-weight: bold;">Tenaga Kerja 2:</label>
        <input type="text" name="tenaga_kerja_2" id="tenaga_kerja_2"
               value="{{ old('tenaga_kerja_2', $dataProgram->tenaga_kerja_2) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="posisi_2" style="display: block; font-weight: bold;">Posisi 2:</label>
        <input type="text" name="posisi_2" id="posisi_2"
               value="{{ old('posisi_2', $dataProgram->posisi_2) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="tenaga_kerja_3" style="display: block; font-weight: bold;">Tenaga Kerja 3:</label>
        <input type="text" name="tenaga_kerja_3" id="tenaga_kerja_3"
               value="{{ old('tenaga_kerja_3', $dataProgram->tenaga_kerja_3) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="posisi_3" style="display: block; font-weight: bold;">Posisi 3:</label>
        <input type="text" name="posisi_3" id="posisi_3"
               value="{{ old('posisi_3', $dataProgram->posisi_3) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="tenaga_kerja_4" style="display: block; font-weight: bold;">Tenaga Kerja 4:</label>
        <input type="text" name="tenaga_kerja_4" id="tenaga_kerja_4"
               value="{{ old('tenaga_kerja_4', $dataProgram->tenaga_kerja_4) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="posisi_4" style="display: block; font-weight: bold;">Posisi 4:</label>
        <input type="text" name="posisi_4" id="posisi_4"
               value="{{ old('posisi_4', $dataProgram->posisi_4) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="tenaga_kerja_5" style="display: block; font-weight: bold;">Tenaga Kerja 5:</label>
        <input type="text" name="tenaga_kerja_5" id="tenaga_kerja_5"
               value="{{ old('tenaga_kerja_5', $dataProgram->tenaga_kerja_5) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div style="margin-bottom: 15px;">
        <label for="posisi_5" style="display: block; font-weight: bold;">Posisi 5:</label>
        <input type="text" name="posisi_5" id="posisi_5"
               value="{{ old('posisi_5', $dataProgram->posisi_5) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Program
    </button>
</form>
@endsection
