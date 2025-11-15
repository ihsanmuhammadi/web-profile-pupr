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
            <th>Waktu Mulai</th>
            <th>Waktu Selesai</th>
            <th>Tahun Anggaran</th>
            <th>Kecamatan</th>
            <th>Lokasi</th>
            <th>Status Proyek</th>
            <th>Kategori</th>
            <th>Dokumentasi</th>
            <th>Tenaga Kerja 1</th>
            <th>Posisi 1</th>
            <th>Tenaga Kerja 2</th>
            <th>Posisi 2</th>
            <th>Tenaga Kerja 3</th>
            <th>Posisi 3</th>
            <th>Tenaga Kerja 4</th>
            <th>Posisi 4</th>
            <th>Tenaga Kerja 5</th>
            <th>Posisi 5</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($dataPrograms as $d)
            <tr>
                <td>{{ e($d->judul) }}</td>
                <td>{{ e($d->sub_judul ?? '-') }}</td>
                <td>{{ e(Str::limit($d->deskripsi, 100) ?? '-') }}</td>
                <td>{{ e($d->waktu_mulai ? \Carbon\Carbon::parse($d->waktu_mulai)->format('d M Y') : '-') }}</td>
                <td>{{ e($d->waktu_selesai ? \Carbon\Carbon::parse($d->waktu_selesai)->format('d M Y') : '-') }}</td>
                <td>{{ e($d->tahun_anggaran ?? '-') }}</td>
                <td>{{ e($d->kecamatan ?? '-') }}</td>
                <td>{{ e($d->lokasi ?? '-') }}</td>
                <td>{{ e($d->status_proyek ?? '-') }}</td>
                <td>{{ e(optional($d->kategori)->name ?? '-') }}</td>
                <td>{{ e($d->dokumentasi ?? '-') }}</td>
                <td>{{ e($d->tenaga_kerja_1 ?? '-') }}</td>
                <td>{{ e($d->posisi_1 ?? '-') }}</td>
                <td>{{ e($d->tenaga_kerja_2 ?? '-') }}</td>
                <td>{{ e($d->posisi_2 ?? '-') }}</td>
                <td>{{ e($d->tenaga_kerja_3 ?? '-') }}</td>
                <td>{{ e($d->posisi_3 ?? '-') }}</td>
                <td>{{ e($d->tenaga_kerja_4 ?? '-') }}</td>
                <td>{{ e($d->posisi_4 ?? '-') }}</td>
                <td>{{ e($d->tenaga_kerja_5 ?? '-') }}</td>
                <td>{{ e($d->posisi_5 ?? '-') }}</td>
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
                <td colspan="22">No data program entries found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
