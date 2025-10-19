@extends('dummylayouts.app')

@section('content')
<h2>Guidance List</h2>
<a href="{{ route('guidances.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Link</th>
            <th>Kategori</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($guidances as $g)
            <tr>
                <td><a href="{{ e($g->link) }}" target="_blank">{{ e($g->link) }}</a></td>
                <td>{{ e($g->kategori ?? 'No category') }}</td>
                <td>
                    <a href="{{ route('guidances.edit', $g->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('guidances.destroy', $g->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No guidance entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
