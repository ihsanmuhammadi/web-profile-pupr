@extends('dummylayouts.app')

@section('content')
<h2>Work List</h2>
<a href="{{ route('works.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Posisi</th>
            <th>Jenis</th>
            <th>Tipe</th>
            <th>Lokasi</th>
            <th>Gaji</th>
            <th>Deskripsi</th>
            <th>Kualifikasi</th>
            <th>Program Terkait</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($works as $work)
            <tr>
                <td>{{ e($work->posisi) }}</td>
                <td>{{ e($work->jenis) }}</td>
                <td>{{ e($work->tipe) }}</td>
                <td>{{ e($work->lokasi) }}</td>
                <td>Rp{{ number_format($work->gaji, 0, ',', '.') }}</td>
                <td>{{ e(Str::limit($work->deskripsi, 100)) }}</td>
                <td>{{ e(Str::limit($work->kualifikasi, 100)) }}</td>
                <td>{{ e(optional($work->dataProgram)->judul ?? '-') }}</td>
                <td>
                    <a href="{{ route('works.edit', $work->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('works.destroy', $work->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9">No work entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
