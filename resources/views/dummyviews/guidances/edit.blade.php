@extends('dummylayouts.app')

@section('content')
<h2>Edit Guidance</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('guidances.update', $guidance->id) }}" method="POST">
    @csrf @method('PUT')
    <label>Link:</label>
    <input type="text" name="link" value="{{ old('link', $guidance->link) }}">
    <label>Kategori:</label>
    <input type="text" name="kategori" value="{{ old('kategori', $guidance->kategori) }}">
    <button type="submit">Update</button>
</form>
@endsection
