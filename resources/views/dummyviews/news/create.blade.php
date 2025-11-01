@extends('dummylayouts.app')

@section('content')
<h2>Create News</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 500px;">
    @csrf

    <div style="margin-bottom: 15px;">
        <label for="judul" style="display: block; font-weight: bold;">Judul:</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="gambar" style="display: block; font-weight: bold;">Gambar (Image Upload):</label>
        <input type="file" name="gambar" id="gambar"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        💾 Save News
    </button>
</form>
@endsection
