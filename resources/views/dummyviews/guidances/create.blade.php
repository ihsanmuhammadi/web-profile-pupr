@extends('dummylayouts.app')

@section('content')
<h2>Create Guidance</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('guidances.store') }}" method="POST">
    @csrf
    <label>Link:</label>
    <input type="text" name="link" value="{{ old('link') }}">
    <label>Kategori:</label>
    <input type="text" name="kategori" value="{{ old('kategori') }}">
    <button type="submit">Save</button>
</form>
@endsection
