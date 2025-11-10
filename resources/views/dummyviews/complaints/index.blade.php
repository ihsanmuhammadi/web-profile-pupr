@extends('dummylayouts.app')

@section('content')
<h2>Complaint List</h2>
<a href="{{ route('complaints.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($complaints as $complaint)
            <tr>
                <td>{{ e($complaint->nama) }}</td>
                <td>{{ e($complaint->email ?? '-') }}</td>
                <td>{{ e(Str::limit($complaint->pesan ?? '-', 100)) }}</td>
                <td>
                    <a href="{{ route('complaints.edit', $complaint->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No complaint entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
