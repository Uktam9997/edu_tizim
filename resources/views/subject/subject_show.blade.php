@extends('layout.header_footer')
@section('content')

<link rel="stylesheet" href="{{ asset('css/subject_show.css') }}">

<a href="{{route('subject.subject_create')}}">Create Subject</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Subject Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 1; @endphp
        @foreach($subjects as $subject)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $subject->subject_name }}</td>
            <td>
                <a href="{{ route('subject.subject_edit', $subject->id) }}">Edit</a>
                <form action="{{ route('subject.subject_delete', $subject->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection