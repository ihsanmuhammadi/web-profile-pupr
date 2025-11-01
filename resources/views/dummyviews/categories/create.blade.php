@extends('dummylayouts.app')

@section('content')
<h2>Create Category</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST" style="max-width: 500px;">
    @csrf

    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; font-weight: bold;">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; font-weight: bold;">Deskripsi:</label>
        <textarea name="description" id="description"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('description') }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tujuan" style="display: block; font-weight: bold;">Tujuan:</label>
        <textarea name="tujuan" id="tujuan"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('tujuan') }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="contoh_program" style="display: block; font-weight: bold;">Contoh Program:</label>
        <textarea name="contoh_program" id="contoh_program"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('contoh_program') }}</textarea>
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
        💾 Save Category
    </button>
</form>
@endsection
