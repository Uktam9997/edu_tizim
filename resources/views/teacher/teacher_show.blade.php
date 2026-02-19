@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/teacher_show.css') }}">
<a href="{{route('teacher.teacher_create')}}">Create Teacher</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $teacher->fullname }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>
                <a href="{{ route('teacher.teacher_edit', $teacher->id) }}">Edit</a>
                <form action="{{ route('teacher.teacher_delete', $teacher->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection