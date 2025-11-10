@extends('dummylayouts.app')

@section('content')
<h2>Edit Complaint</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ e($error) }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('complaints.update', $complaint->id) }}" method="POST" style="max-width: 600px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="nama" style="display: block; font-weight: bold;">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $complaint->nama) }}" maxlength="255" required
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display: block; font-weight: bold;">Email (opsional)</label>
        <input type="email" name="email" id="email" value="{{ old('email', $complaint->email) }}" maxlength="255"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="pesan" style="display: block; font-weight: bold;">Pesan (opsional)</label>
        <textarea name="pesan" id="pesan" maxlength="1000"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; min-height: 120px;">{{ old('pesan', $complaint->pesan) }}</textarea>
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Complaint
    </button>
</form>
@endsection
