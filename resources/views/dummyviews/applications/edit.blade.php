@extends('dummylayouts.app')

@section('content')
<h2>Edit Work</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('works.update', $work->id) }}" method="POST" style="max-width: 600px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="posisi" style="display: block; font-weight: bold;">Posisi:</label>
        <input type="text" name="posisi" id="posisi" value="{{ old('posisi', $work->posisi) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="jenis" style="display: block; font-weight: bold;">Jenis:</label>
        <input type="text" name="jenis" id="jenis" value="{{ old('jenis', $work->jenis) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tipe" style="display: block; font-weight: bold;">Tipe:</label>
        <input type="text" name="tipe" id="tipe" value="{{ old('tipe', $work->tipe) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="lokasi" style="display: block; font-weight: bold;">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $work->lokasi) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="gaji" style="display: block; font-weight: bold;">Gaji:</label>
        <input type="number" name="gaji" id="gaji" value="{{ old('gaji', $work->gaji) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="deskripsi" style="display: block; font-weight: bold;">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('deskripsi', $work->deskripsi) }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="kualifikasi" style="display: block; font-weight: bold;">Kualifikasi:</label>
        <textarea name="kualifikasi" id="kualifikasi"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('kualifikasi', $work->kualifikasi) }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="data_program_id" style="display: block; font-weight: bold;">Program Terkait:</label>
        <select name="data_program_id" id="data_program_id"
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Program --</option>
            @foreach ($dataPrograms as $program)
                <option value="{{ $program->id }}" {{ old('data_program_id', $work->data_program_id) == $program->id ? 'selected' : '' }}>
                    {{ $program->judul }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Work
    </button>
</form>
@endsection
