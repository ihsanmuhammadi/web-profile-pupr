@extends('dummylayouts.app')

@section('content')
<h2>Edit Application</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('applications.update', $application->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="nama" style="display: block; font-weight: bold;">Nama:</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $application->nama) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="nomor_telepon" style="display: block; font-weight: bold;">Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $application->nomor_telepon) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; font-weight: bold;">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $application->email) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="lokasi" style="display: block; font-weight: bold;">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $application->lokasi) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="pendidikan" style="display: block; font-weight: bold;">Pendidikan:</label>
        <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan', $application->pendidikan) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="jurusan" style="display: block; font-weight: bold;">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $application->jurusan) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="cv" style="display: block; font-weight: bold;">CV (PDF only):</label>
        <input type="file" name="cv" id="cv"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        @if ($application->cv)
            <p style="margin-top: 5px;">Current CV:
                <a href="{{ asset('storage/'.$application->cv) }}" target="_blank">Download</a>
            </p>
        @endif
    </div>

    <div style="margin-bottom: 15px;">
        <label for="portofolio" style="display: block; font-weight: bold;">Portofolio:</label>
        <input type="text" name="portofolio" id="portofolio" value="{{ old('portofolio', $application->portofolio) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <input type="hidden" name="work_id" value="{{ $application->work_id }}">

    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Application
    </button>
</form>
@endsection
