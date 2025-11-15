@extends('dummylayouts.app')

@section('content')
<h2>Application List</h2>
<a href="{{ route('applications.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Lokasi</th>
            <th>Pendidikan</th>
            <th>Jurusan</th>
            <th>Portofolio</th>
            <th>CV</th>
            <th>Pekerjaan</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($applications as $application)
            <tr>
                <td>{{ e($application->nama) }}</td>
                <td>{{ e($application->nomor_telepon) }}</td>
                <td>{{ e($application->email) }}</td>
                <td>{{ e($application->lokasi) }}</td>
                <td>{{ e($application->pendidikan) }}</td>
                <td>{{ e($application->jurusan) }}</td>
                <td>{{ e(Str::limit($application->portofolio, 50)) }}</td>
                <td>
                    @if($application->cv)
                        <a href="{{ asset('storage/' . $application->cv) }}" target="_blank">📄 Lihat CV</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ e(optional($application->work)->posisi ?? '-') }}</td>
                <td>
                    <a href="{{ route('applications.edit', $application->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No application entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
