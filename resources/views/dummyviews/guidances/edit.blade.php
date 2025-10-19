@extends('dummylayouts.app')

@section('content')
<h2>Edit Guidance</h2>

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guidances.update', $guidance->id) }}" method="POST" style="max-width: 500px;">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="link" style="display: block; font-weight: bold;">Link:</label>
        <input type="text" name="link" id="link" value="{{ old('link', $guidance->link) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="kategori" style="display: block; font-weight: bold;">Kategori:</label>
        <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $guidance->kategori) }}"
               style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <button type="submit"
            style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer;">
        🔄 Update Guidance
    </button>
</form>
@endsection
