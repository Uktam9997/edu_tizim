@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/student_show.css') }}">
<a href="{{ route('student.student_create') }}">Create student</a>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Group 1</th>
            <th>Group 2</th>
            <th>Group 3</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($students as $student)
        @php $groups = $student->groups; @endphp
        <tr>
            <td>{{ $i++ }}</td>
            <td>
                <a href="{{ route('student.student_first_groups_show', $student->id) }}">
                    {{ $student->fullname }}
                </a>
            </td>

            {{-- Group 1 --}}
            <td>
                @if(isset($groups[0]))
                <a href="{{ route('group.group_first_show', $groups[0]->id) }}">
                    {{ $groups[0]->group_name }}
                </a>
                @else
                No group
                @endif
            </td>

            {{-- Group 2 --}}
            <td>
                @if(isset($groups[1]))
                <a href="{{ route('group.group_first_show', $groups[1]->id) }}">
                    {{ $groups[1]->group_name }}
                </a>
                @else
                No group
                @endif
            </td>

            {{-- Group 3 --}}
            <td>
                @if(isset($groups[2]))
                <a href="{{ route('group.group_first_show', $groups[2]->id) }}">
                    {{ $groups[2]->group_name }}
                </a>
                @else
                No group
                @endif
            </td>

            <td>
                <a href="{{ route('student.student_edit', $student->id) }}">Edit</a>
                <form action="{{ route('student.student_delete', $student->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection