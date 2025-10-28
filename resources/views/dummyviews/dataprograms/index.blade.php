@extends('dummylayouts.app')

@section('content')
<h2>Data Program List</h2>
<a href="{{ route('data-programs.create') }}" style="display:inline-block; margin-bottom: 10px;">➕ Add New</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>Judul</th>
            <th>Sub Judul</th>
            <th>Deskripsi</th>
            <th>Waktu Pelaksanaan</th>
            <th>Tahun Anggaran</th>
            <th>Lokasi</th>
            <th>Status Proyek</th>
            <th>Kategori</th>
            <th>Dokumentasi</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataPrograms as $d)
            <tr>
                <td>{{ e($d->judul) }}</td>
                <td>{{ e($d->sub_judul ?? '-') }}</td>
                <td>{{ e(Str::limit($d->deskripsi, 100) ?? '-') }}</td>
                <td>{{ e($d->waktu_pelaksanaan ? \Carbon\Carbon::parse($d->waktu_pelaksanaan)->format('d M Y') : '-') }}</td>
                <td>{{ e($d->tahun_anggaran ?? '-') }}</td>
                <td>{{ e($d->lokasi ?? '-') }}</td>
                <td>{{ e($d->status_proyek ?? '-') }}</td>
                <td>{{ e(optional($d->kategori)->name ?? '-') }}</td>
                <td>
                    @php
                        $docs = is_array($d->dokumentasi) ? $d->dokumentasi : json_decode($d->dokumentasi ?? '[]', true);
                    @endphp

                    @if(is_array($docs) && count($docs))
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            @foreach ($docs as $doc)
                                @php
                                    $path = is_string($doc) ? $doc : (is_array($doc) && isset($doc['path']) ? $doc['path'] : null);
                                @endphp

                                @if($path)
                                    <a href="{{ asset('storage/' . $path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $path) }}" alt="Dokumentasi" style="max-width: 100px; max-height: 100px; object-fit: cover; border: 1px solid #ccc; border-radius: 4px;">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <em>-</em>
                    @endif
                </td>
                <td>
                    <a href="{{ route('data-programs.edit', $d->id) }}" style="margin-right: 10px;">✏️ Edit</a>
                    <form action="{{ route('data-programs.destroy', $d->id) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" style="background:none; border:none; color:red; cursor:pointer;">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No data program entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
