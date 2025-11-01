@extends('dummylayouts.app')

@section('content')
<h2>Category List</h2>
<a href="{{ route('categories.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Tujuan</th>
            <th>Contoh Program</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $c)
            <tr>
                <td>{{ e($c->name) }}</td>
                <td>{{ e($c->description ?? '-') }}</td>
                <td>{{ e($c->tujuan ?? '-') }}</td>
                <td>{{ e($c->contoh_program ?? '-') }}</td>
                <td>
                    <a href="{{ route('categories.edit', $c->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No category entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
