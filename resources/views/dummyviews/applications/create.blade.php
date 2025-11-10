@extends('dummylayouts.app')

@section('content')
<h2>Create Application</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ e($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
    @csrf

    {{-- Pekerjaan (work_id - UUID) --}}
    <div style="margin-bottom: 15px;">
        <label for="work_id" style="display: block; font-weight: bold;">Pekerjaan</label>
        <select name="work_id" id="work_id" required
                style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Pilih Pekerjaan --</option>
            @foreach ($works as $work)
                <option value="{{ $work->id }}" {{ old('work_id', request('work')) == $work->id ? 'selected' : '' }}>
                    {{ $work->posisi }} — {{ $work->lokasi }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="nama" style="display: block; font-weight: bold;">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="nomor_telepon" style="display: block; font-weight: bold;">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; font-weight: bold;">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="lokasi" style="display: block; font-weight: bold;">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="pendidikan" style="display: block; font-weight: bold;">Pendidikan</label>
        <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="jurusan" style="display: block; font-weight: bold;">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="portofolio" style="display: block; font-weight: bold;">Portofolio (URL / keterangan singkat)</label>
        <input type="text" name="portofolio" id="portofolio" value="{{ old('portofolio') }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="cv" style="display: block; font-weight: bold;">CV (PDF, maks 5MB)</label>
        <input type="file" name="cv" id="cv" accept="application/pdf" required
               style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        💾 Save Application
    </button>
</form>
@endsection
