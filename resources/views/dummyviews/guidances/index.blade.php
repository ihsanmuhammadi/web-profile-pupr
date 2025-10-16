@extends('dummylayouts.app')

@section('content')
<h2>Guidance List</h2>
<a href="{{ route('guidances.create') }}">Add New</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<ul>
    @foreach ($guidances as $g)
        <li>
            <a href="{{ e($g->link) }}" target="_blank">{{ e($g->link) }}</a>
            ({{ e($g->kategori ?? 'No category') }})
            <a href="{{ route('guidances.edit', $g->id) }}">Edit</a>
            <form action="{{ route('guidances.destroy', $g->id) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
