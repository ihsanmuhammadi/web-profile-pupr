@extends('dummylayouts.app')

@section('content')
<h2>News List</h2>
<a href="{{ route('news.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($news as $n)
            <tr>
                <td>{{ e($n->judul) }}</td>
                <td>
                    @if ($n->gambar)
                        <img src="{{ asset('storage/' . $n->gambar) }}" alt="News Image" style="max-width: 100px;">
                    @else
                        <em>No image</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('news.edit', $n->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('news.destroy', $n->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No news entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
