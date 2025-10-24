@extends('dummylayouts.app')

@section('content')
<h2>Edit Category</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.update', $category->id) }}" method="POST" style="max-width: 500px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="name" style="display: block; font-weight: bold;">Nama:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; font-weight: bold;">Deskripsi:</label>
        <textarea name="description" id="description"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('description', $category->description) }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="tujuan" style="display: block; font-weight: bold;">Tujuan:</label>
        <textarea name="tujuan" id="tujuan"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('tujuan', $category->tujuan) }}</textarea>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="contoh_program" style="display: block; font-weight: bold;">Contoh Program:</label>
        <textarea name="contoh_program" id="contoh_program"
                  style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('contoh_program', $category->contoh_program) }}</textarea>
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Category
    </button>
</form>
@endsection
