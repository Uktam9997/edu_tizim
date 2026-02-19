{{-- filepath: c:\xampp\htdocs\Laravel\resources\views\group\group_show.blade.php --}}
@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/group_show.css') }}">

<div class="button-container">
    <a href="{{route('group.group_create')}}" class="btn">Grux yaratish</a>
    <a href="{{route('group.group_archive_show')}}" class="btn">Arxivlangan gruxlar</a>
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>O'qituvchi</th>
            <th>Grux nomi</th>
            <th>Fan</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($groups as $group)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{route('group.group_first_show', $group->id)}}">{{ $group->teacher?->fullname ?? 'No teacher' }}</a></td>
            <td>{{ $group->group_name }}</td>
            <td>{{ $group->subject?->subject_name ?? 'No subject' }}</td>
            <td>{{ ucfirst($group->status) }}</td>
            <td>
                <a href="{{ route('group.group_edit', $group->id) }}">Yangilash</a>
                <form action="{{ route('group.group_delete', $group->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure?')">O'chirish</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection