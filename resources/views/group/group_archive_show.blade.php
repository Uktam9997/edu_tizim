@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/group_archive_show.css') }}">
<p>Arxivlangan Gruxlar</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Grux Nomi</th>
            <th>O'qituvchi</th>
            <th>Fan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($archivedGroups as $group)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $group->group_name }}</td>
            <td>{{ $group->teacher?->fullname ?? 'O\'qituvchi topilmadi' }}</td>
            <td>{{ $group->subject?->subject_name ?? 'Fan tofilmadi' }}</td>
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